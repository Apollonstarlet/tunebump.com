<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Transactions;
use App\Models\Credits;
use Session;

class PaymentController extends Controller
{
    //
    private $gateway;

    public function __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(false);
    }

    public function pay(Request $request){
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if($response->isRedirect()) {
                $response->redirect();
            } else{
                return $response->getMessage();
            }
        } catch (\Throwable $th){
            return $th->getMessage();
        }
    }

    public function success(Request $request){
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        
        if ($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if($response->isSuccessful()){
                $arr = $response->getData();
                $transactions = new Transactions();
                $transactions->userId = $request->user()->id;
                $transactions->paypal = 'paypal';
                $amount = $arr['transactions'][0]['amount']['total'];
                $transactions->amount = $amount;
                $transactions->description = $amount*10;
                $transactions->status = 'Paid';
                $transactions->save();
        
                $credits = Credits::where('userId', $request->user()->id)->first();
                $credits->credits += $amount*10;
                $credits->save();
        
                // $payment = new Payment();
                // $payment->payment_id = $arr['id'];
                // $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                // $payment->payer_email = $arr['payer']['payer_info']['email'];
                // $payment->amount = $arr['transactions'][0]['amount']['total'];
                // $payment->currency = env('PAYPAL_CURRENCY');
                // $payment->payment_status = $arr['state'];
                // $payment->save(); 
                Session::flash('success', 'Payment successful! Credits are added to your balance.');
            } else{
                Session::flash('error', $response->getMessage());
            }
        } else{
            Session::flash('error', 'Payment canceled.');
        }
        return redirect()->route('credits');
        //return view('/artist/credits', ['pageConfigs' => $pageConfigs]);
    }

    public function error(){
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        Session::flash('error', 'User decliened!');
        return redirect()->route('credits');
    }
}