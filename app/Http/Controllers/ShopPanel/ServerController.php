<?php

namespace App\Http\Controllers\ShopPanel;

use App\Http\Controllers\Controller;
use App\Server;
use App\Setting;
use App\Site;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZanySoft\Zip\Zip;


class ServerController extends Controller
{
    public $site_id;

    /**
     * ServerController constructor.
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
        $servers = Server::where('site_id', $this->site_id)->get();
        return view('shop_panel.pages.server_add', compact('servers'));
    }

    /**
     * @param null $slug
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($slug = null, $id)
    {
        $server = Server::where('site_id', $this->site_id)->where('id', $id);
        $server->delete();

        return response()->json(['Успешно', 200]);
    }

    /**
     * @param $slug
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($slug, Request $request)
    {
        $site = Site::where('slug', $slug)->first();
        $server_count = Server::where('site_id', $this->site_id)->count();

        if ($server_count == $site->plan->servers) {
            return response()->json(['max' => true], 400);
        }

        $request->validate(['server' => 'min:2|required']);

        $server = new Server();
        $server->token = md5($request->input('server')) . time() . 'my_mc_shop';
        $server->name = $request->input('server');
        $server->site_id = $this->site_id;

        $server->save();

        return response()->json(['Успешно'], 201);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function status_page()
    {
        $current_ip = Setting::where('site_id', $this->site_id)->where('key', 'server_status')->first()->value;
        return view('shop_panel.pages.server_status', compact('current_ip'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatestatus(Request $request)
    {
        $request->validate(['sstatus' => 'min:3|required']);

        $current_ip = Setting::where('site_id', $this->site_id)->where('key', 'server_status');
        $current_ip->update(['value' => $request->input('sstatus')]);

        return response()->json(['Успешно'], 200);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function connection_page()
    {
        $servers = Server::where('site_id', $this->site_id)->get()->pluck('name', 'token');
        return view('shop_panel.pages.server_conn', compact('servers'));
    }

    public function configure(Request $request)
    {
        $request->validate(['server' => 'required']);

        $file = fopen(public_path('server_configurations\MyMCShop\config.yml'), "w");

        ftruncate($file, 0);
        fwrite($file, "api_uri: " . $request->root() . "\n");
        fwrite($file, "token: " . $request->input('server') . "\n");
        fwrite($file, "interval: 2000\n");
        fclose($file);
        $zip = new \ZipArchive();
        $file_name = $this->site_id. '-' . $request->route()->parameter('slug') .str_random(5,7). '.zip';
        if ($zip->open(getcwd() . '/'.$file_name, \ZipArchive::CREATE) === TRUE) {
            $zip->addFile(getcwd() . '/server_configurations/MyMCShop/config.yml', 'MyMCShop/config.yml');
            $zip->addFile(getcwd() . '/server_configurations/myMCShop.jar', 'myMCShop.jar');
            $zip->close();
        }
        return response()->download(public_path($file_name))->deleteFileAfterSend(true);
    }
}
