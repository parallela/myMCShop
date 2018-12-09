<?php

namespace App\Http\Controllers\ShopPanel;

use App\Http\Controllers\Controller;
use App\MCUser;
use App\Order;
use App\Server;
use App\Setting;
use App\Site;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public $site_id;

    /**
     * HomeController constructor.
     */
    public function __construct(Request $request)
    {
        $site_id = Site::where('slug', $request->route()->parameter('slug'))->first()->id;
        $this->site_id = $site_id;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $order = new Order();

        $totalPrice = $order->getTotalPrice($this->site_id);
        $totalServers = Server::where('site_id', $this->site_id)->count();
        $todayTurnonver = $order->getTodayTurnover($this->site_id);
        $todayUsers = MCUser::whereDate('created_at', Carbon::today())->where('site_id',$this->site_id)->take(4)->get();

        $users = MCUser::where('site_id', $this->site_id)->select('id', 'created_at')->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$i] = $usermcount[$i];
            } else {
                $userArr[$i] = 0;
            }
        }

        $months = [];
        $statistic = [];
        foreach ($userArr as $t => $value) {
            $months[] = [jdmonthname(gregoriantojd($t, 1, 1), CAL_MONTH_GREGORIAN_LONG)];
            $statistic[] = [$value];
        }


        $yearUserChart = app()->chartjs
            ->name('userChart')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($months)
            ->datasets([
                [
                    "label" => "Регистрирани потребители за тази година",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $statistic,
                ],
            ])
            ->options([]);


        return view('shop_panel.index', compact('totalPrice', 'totalServers', 'todayTurnonver', 'todayUsers', 'yearUserChart'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatetitle(Request $request)
    {

        $validator = Validator::make($request->all(),[
           'title' => 'required|min:3'
        ]);

        if($validator->fails()) {
            return response()->json(['Полето не може да бъде празно или по-малко от 3 букви!'],400);
        }

        $title = $request->input('title');

        Setting::where('key','title')->where('site_id',$this->site_id)->update(['value'=>$title]);

        return response()->json(['Успешно'],201);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatekeywords(Request $request)
    {

        $validator = Validator::make($request->all(),[
           'keywords' => 'required|min:3'
        ]);

        if($validator->fails()) {
            return response()->json(['Полето не може да бъде празно или по-малко от 3 букви!'],400);
        }

        $keywords = $request->input('keywords');

        Setting::where('key','meta_keywords')->where('site_id',$this->site_id)->update(['value'=>$keywords]);

        return response()->json(['Успешно'],201);

    }
}
