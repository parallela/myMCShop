<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Plan;
use App\Site;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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

    /**
     * CheckoutController constructor.
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function proccess(Request $request)
    {

        $request->validate(['p_id'=> 'required|integer']);

        $plan = Plan::find($request->input('p_id'));
        $site = Site::find($request->input('s_id'));

        Session::put('site_id',$site->id);
        Session::put('plan_id', $plan->id);

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
        $redirect_url->setReturnUrl(route('manage.check'));
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
            $site_id = Session::get('site_id');

            $site = Site::find($site_id);
            $site->plan_id = $plan_id;
            $site->update();

            return redirect()->to(route('purchaseSuccess'));
        }

        return redirect()->to(route('purchaseFailed', ['approved' => true]))->withErrors(['codeError' => 'Failed.']);
    }
}
