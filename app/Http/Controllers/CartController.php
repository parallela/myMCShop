<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteCreateRequest;
use App\Plan;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Support\Facades\Session;
use Auth;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use DB;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Carbon\Carbon;


class CartController extends Controller
{

    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page(Request $request)
    {
        $id = $request->input('p_id');
        $find_plan = Plan::find($id);
        Session::put('plan',$find_plan);

        $plan = Session::get('plan');

        return view('site_pages.checkout', compact('plan'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function proccess(SiteCreateRequest $request)
    {

        $plan = Plan::find($request->input('p_id'));

        Session::put('plan_id', $plan->id);
        Session::put('user_id', Auth::user()->id);
        Session::put('slug',$request->input('slug'));

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $item->setName($plan->name)
            ->setCurrency('EUR')
            ->setPrice($plan->price)
            ->setQuantity(1);
        $items[] = $item;
        $itemlist = new ItemList();
        $itemlist->setItems($items);
        $amount = new Amount();
        $amount->setCurrency('EUR')->setTotal($item->getQuantity() * $plan->price);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemlist)->setDescription('You purchase: ' . $plan->name);
        $redirect_url = new RedirectUrls();
        $redirect_url->setReturnUrl(route('check'));
        $redirect_url->setCancelUrl(route('purchaseFailed'));
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
                return redirect()->to(route('purchaseFailed'))->withErrors(['codeError' => 'Failed.']);
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        return redirect()->to(route('purchaseFailed'))->withErrors(['codeError' => 'Failed.']);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function check(Request $request, Site $site)
    {
        $payment_id = $request->paymentId;

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return redirect()->to(route('purchaseFailed'))->withErrors(['codeError' => 'Failed.']);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $plan_id = Session::get('plan_id');
            $user_id = User::find(Session::get('user_id'))->id;
            $site_name = Session::get('slug');

            $site->createShop($site_name,$user_id,$plan_id);

            return redirect()->to(route('purchaseSuccess'));
        }

        return redirect()->to(route('purchaseFailed', ['approved' => true]))->withErrors(['codeError' => 'Failed.']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success()
    {
        return view('site_pages.purchaseSuccess');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return view('site_pages.failed');
    }

}
