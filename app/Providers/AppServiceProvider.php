<?php

namespace App\Providers;

use App\Cart;
use App\Category;
use App\Order;
use App\Product;
use App\Setting;
use App\Site;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('shop.themes.*', function ($view) {
            $site_slug = Route::current()->parameter('slug');
            $site = Site::where('slug', $site_slug)->first();
            $theme = Setting::where('key', 'theme')->where('site_id', $site->id)->first()->value;
            $background_image = Setting::where('key', 'background')->where('site_id', $site->id)->first()->value;
            $title = Setting::where('key', 'title')->where('site_id', $site->id)->first()->value;
            $meta_desc = Setting::where('key', 'meta_keywords')->where('site_id', $site->id)->first()->value;
            $logo = Setting::where('key', 'logo')->where('site_id', $site->id)->first()->value;
            $sidebars = Site::find($site->id)->sidebars()->orderBy('position', 'asc')->get();
            $categories = Category::where('parent_id', NULL)->where('site_id', $site->id)->get();
            $subcategories = Category::where('parent_id', '!=', NULL)->where('site_id', $site->id)->get();

            // Sidebar
            $take_amount = Setting::where('key', 'show_log_amount')->where('site_id', $site->id)->first()->value;
            $orders_with_user = Order::with('user', 'product')->orderBy('created_at', 'desc')->get();
            $latestorders = $orders_with_user->take($take_amount)->where('user.site_id', $site->id)->where('product.site_id', $site->id);
            $recommended = Product::where('site_id', $site->id)->where('recommended', 1)->first();
            $extras = Product::where('site_id', $site->id)->get();

            // donations
            $donationGoal = Setting::where('key', 'donation_goal')->where('site_id', $site->id)->first()->value;
            $donationGoalText = Setting::where('key', 'donation_goal_text')->where('site_id', $site->id)->first()->value;
            $donationGoalCurrentGet = Order::with('product')->get();
            $donationAmount = floor($donationGoalCurrentGet->where('product.site_id', $site->id)->sum('product.price'));

            $userOrders = Auth::guard('mcuser')->check() ? Order::where('m_c_user_id', Auth::guard('mcuser')->user()->id)->where('site_id', $site->id)->get() : '';

            // Status API
            $s_data = Setting::where('key', 'server_status')->where('site_id', $site->id)->first()->value;
            $ip = explode(':', $s_data);
            if (count($ip) < 2) {
                $ip[1] = 25565;
            }

            try {

                $Query = new MinecraftPing($ip[0], $ip[1]);
                $s_status = $Query->Query();
                if ($s_status) {
                    $Query->Close();
                }

            } catch (MinecraftPingException $e) {
                report($e);
            }

            // Purchase Date
            if (Auth::guard('mcuser')->check()) {
                $lastPurchaseDate = (empty(Auth::guard('mcuser')->user()->orders()->where('site_id', $site->id)->orderBy('created_at', 'desc')->first())) ? '' : Auth::guard('mcuser')->user()->orders()->where('site_id', $site->id)->orderBy('created_at', 'desc')->first()->created_at->toFormattedDateString();
                $donatedPriceGet = Order::with('product')->get();
                $donatedPrice = $donatedPriceGet->where('product.site_id', $site->id)->where('m_c_user_id', Auth::guard('mcuser')->user()->id)->sum('product.price');
                $lastPurchase = empty(Auth::guard('mcuser')->user()->orders()->where('site_id', $site->id)->orderBy('created_at', 'desc')->first()->product->name) ? 'None' : Auth::guard('mcuser')->user()->orders()->where('site_id', $site->id)->orderBy('created_at', 'desc')->first()->product->name;
                $cartItem = Cart::where('user_id', Auth::guard('mcuser')->user()->id)->where('site_id', $site->id)->first();
                if (empty($cartItem)) {
                    $cartCount = 0;
                } else {
                    $cartCount = $cartItem->where('user_id', Auth::guard('mcuser')->user()->id)->count();
                    $cartItem = Cart::where('user_id', Auth::guard('mcuser')->user()->id)->first();
                }

            }

            $view->with(compact('theme', 'background_image', 'title', 'logo',
                'sidebars', 'categories',
                'subcategories', 'site', 'donatedPrice', 'lastPurchaseDate',
                'lastPurchase', 's_status', 'ip', 'latestorders',
                'userOrders', 'extras', 'recommended',
                'donationGoalText', 'donationGoal', 'donationAmount',
                'cartCount', 'cartItem', 'meta_desc'));

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
