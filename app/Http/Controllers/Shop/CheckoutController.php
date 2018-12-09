<?php

namespace App\Http\Controllers\Shop;

use App\Cart;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\MCUser;
use App\Product;
use App\Setting;
use App\Site;
use App\Sms;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class CheckoutController extends Controller
{
    public $theme;
    public $site_id;
    private $site;

    /**
     * CartController constructor.
     */
    public function __construct(Request $request)
    {
        $site = Site::where('slug', $request->route()->parameter('slug'))->first();
        if (empty($site)) {
            abort(404);
        }

        $site_id = $site->id;

        $theme = Setting::where('key', 'theme')->where('site_id', $site_id)->first()->value;

        $this->theme = $theme;
        $this->site_id = $site_id;
        $this->middleware('mcAuth');
        $this->site = $site;

        //Paypal
        $paypal_client = Setting::where('key', 'paypal_client_id')->where('site_id', $this->site_id)->first()->value;
        $paypal_secret = Setting::where('key', 'paypal_secret')->where('site_id', $this->site_id)->first()->value;
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_client, $paypal_secret));
        $this->_api_context->setConfig([
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => false,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'FINE'
        ]);
    }

    public function sms_checkout(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'privacyConsent' => 'required',
            'agreement' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->to('/cart/failed')->withErrors($validator->errors());
        }

        // Variables with ids

        $product = Product::where('id', $request->input('product_id'))->where('site_id', $this->site_id)->first();
        $user = $request->has('gift') ? MCUser::where('username', $request->input('gift'))->where('site_id', $this->site_id) : Auth::guard('mcuser')->user();
        $smsUserID = $product->sms->userID != null ? $product->sms->userID : '';
        $servID = $product->sms->servID;
        if($product->sms_id == 0) {
            return redirect()->to('cart/failed')->withErrors(['codeError'=>'Невалидни SMS данни! Моля свържете се със собственика на сайта!']);
        }

        // Gift validation
        if ($user == null && $request->has('gift')) {
            return redirect()->to('/cart/failed', __('messages.noUserExist'));
        } else if ($product->required_product_id != 0 && $request->has('gift')) {
            return redirect()->to('cart/failed', __('messages.noUserUpgrade'));
        }

        $cart = new Cart();
        $sms = new Sms();

        $smsmethod = Setting::where('key', 'sms_pay_method')->where('site_id', $this->site_id)->first()->value;

        if (session()->has('coupon')) {
            $coupon = Coupon::find(session()->get('couponID'));
            $product_price = session()->get('currency') == 'EUR' ? floor($product->price / 1.95) : $product->price;

            if ($coupon->budget >= $product_price) {
                $coupon->budget = round($coupon->budget) - round($product_price);
                $coupon->update();
                $cart->success($product, $user, $this->site_id);

                return redirect()->to('/');
            } else {
                return redirect()->to('/cart/failed')->withErrors(['codeError' => "Нямате достатъчно пари в купона за да закупите това"]);
            }
        } else {
            if ($product->only_paypal != 1) {
                if ($smsmethod == "mobio") {
                    if ($product->price <= 6) {
                        if (!$cart->mobio_check($servID, $request->input('code'))) {
                            return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => 1])]);
                        }
                    } else if ($product->price == 9.6 || $product->price == 12) {
                        for ($i = 0; $i < 2; $i++) {
                            $int = $i + 1;
                            if (!$cart->mobio_check($servID, $request->input("code$int"))) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    } else if ($product->price == 18) {
                        for ($i = 0; $i < 3; $i++) {
                            $int = $i + 1;
                            if (!$cart->mobio_check($servID, $request->input("code$int"))) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    } else if ($product->price == 24) {
                        for ($i = 0; $i < 4; $i++) {
                            $int = $i + 1;
                            if (!$cart->mobio_check($servID, $request->input("code$int"))) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    }
                } else if ($smsmethod == "smspay") {
                    if ($product->price <= 6) {
                        if (!$cart->smspay_check($servID, $request->input('code'), $smsUserID)) {
                            return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => 1])]);
                        }
                    } else if ($product->price == 9.6 || $product->price == 12) {
                        for ($i = 0; $i < 2; $i++) {
                            $int = $i + 1;
                            if (!$cart->smspay_check($servID, $request->input("code$int"), $smsUserID)) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    } else if ($product->price == 18) {
                        for ($i = 0; $i < 3; $i++) {
                            $int = $i + 1;
                            if (!$cart->smspay_check($servID, $request->input("code$int"), $smsUserID)) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    } else if ($product->price == 24) {
                        for ($i = 0; $i < 4; $i++) {
                            $int = $i + 1;
                            if (!$cart->smspay_check($servID, $request->input("code$int"), $smsUserID)) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    }
                } else if ($smsmethod == "yesspay") {
                    if ($product->price <= 6) {
                        if (!$cart->yesspay_check($servID, $request->input('code'))) {
                            return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => 1])]);
                        }
                    } else if ($product->price == 9.6 || $product->price == 12) {
                        for ($i = 0; $i < 2; $i++) {
                            $int = $i + 1;
                            if (!$cart->yesspay_check($servID, $request->input("code$int"))) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    } else if ($product->price == 18) {
                        for ($i = 0; $i < 3; $i++) {
                            $int = $i + 1;
                            if (!$cart->yesspay_check($servID, $request->input("code$int"))) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    } else if ($product->price == 24) {
                        for ($i = 0; $i < 4; $i++) {
                            $int = $i + 1;
                            if (!$cart->yesspay_check($servID, $request->input("code$int"))) {
                                return redirect()->to('/cart/failed')->withErrors(['codeError' => __('messages.invalidCode', ['input' => $int])]);
                            }
                        }
                    }
                }
                $cart->success($product, $user, $this->site_id);
                return redirect()->to('/');
            } else {
                return redirect()->to('/');
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paypal_checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'privacyConsent' => 'required',
            'agreement' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->to('/cart/failed')->withErrors($validator->errors());
        }

        // Variables with ids

        $product = Product::where('id', $request->input('product_id'))->where('site_id', $this->site_id)->first();
        $user = $request->has('gift') ? MCUser::where('username', $request->input('gift'))->where('site_id', $this->site_id) : Auth::guard('mcuser')->user();

        // Gift validation
        if ($user == null && $request->has('gift')) {
            return redirect()->to('/cart/failed', __('messages.noUserExist'));
        } else if ($product->required_product_id != 0 && $request->has('gift')) {
            return redirect()->to('/cart/failed', __('messages.noUserUpgrade'));
        }

        $cart = new Cart();

        if (session()->has('coupon')) {
            $coupon = Coupon::find(session()->get('couponID'));
            $product_price = session()->get('currency') == 'EUR' ? floor($product->price / 1.95) : $product->price;

            if ($coupon->budget >= $product_price) {
                $coupon->budget = round($coupon->budget) - round($product_price);
                $coupon->update();
                $cart->success($product, $user, $this->site_id);

                return redirect()->to('/');
            } else {
                return redirect()->to('/cart/failed')->withErrors(['codeError' => "Нямате достатъчно пари в купона за да закупите това"]);
            }
        } else {
            if ($this->site->plan->paypal != 0) {
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');
                $item = new Item();
                $item->setName($product->name)
                    ->setCurrency('EUR')
                    ->setPrice(session()->get('currency') == 'EUR' ? floor($product->price / 1.95) : $product->price / 1.95)
                    ->setQuantity(1);
                $items[] = $item;
                $itemlist = new ItemList();
                $itemlist->setItems($items);
                $amount = new Amount();
                $amount->setCurrency('EUR')->setTotal($item->getQuantity() * $item->getPrice());
                $transaction = new Transaction();
                $transaction->setAmount($amount)->setItemList($itemlist)->setDescription('You purchase: ' . $product->name);
                $redirect_url = new RedirectUrls();
                $redirect_url->setReturnUrl(url('/cart/paypal/check'));
                $redirect_url->setCancelUrl(url('/cart/failed'));
                $payment = new Payment();
                $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_url)
                    ->setTransactions(array($transaction));
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        echo "Exception: " . $ex->getMessage() . PHP_EQL;
                    } else {
                        return redirect()->to('/cart/failed')->withErrors(['codeError' => 'Failed.']);
                    }
                }
                foreach ($payment->getLinks() as $link) {
                    if ($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                Session::put('paypal_payment_id', $payment->getId());
                Session::put('product_id', $product->id);
                Session::put('user_id', $user->id);
                if (isset($redirect_url)) {
                    return Redirect::away($redirect_url);
                }
                return redirect()->to('/cart/failed')->withErrors(['codeError' => 'Failed.']);

            } else {
                return redirect()->to('/cart/failed')->withErrors((['codeError'=>'Paypal not allowed! Please upgrade your site!']));
            }

        }
    }

    public function paypal_check(Request $request)
    {

        $payment_id = $request->paymentId;

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return redirect()->to('/cart/failed')->withErrors(['codeError' => 'Failed.']);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $cart = new Cart();
            $product = Product::find(session()->get('product_id'));
            $user = MCUser::find(session()->get('user_id'));
            $cart->success($product, $user, $this->site_id);
            Session::forget('product_id');
            Session::forget('user_id');
            return redirect()->to('/');
        }
        return redirect()->to('/cart/failed')->withErrors(['codeError' => 'Failed.']);

    }
}
