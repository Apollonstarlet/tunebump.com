<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prices;
use App\Models\Credits;
use App\Models\Transactions;

use Session;
use Stripe;

class BalanceController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }
    
    public function Credits(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];

        $data = array();
        $id = $request->user()->id;
        $credits = Credits::where('userId', $id)->first();
        $data['credits'] = $credits->credits;
        $data['transactions'] = Transactions::where('userId', $id)->paginate(10);
        $data['count'] = count($data['transactions']);

        return view('/artist/credits', ['pageConfigs' => $pageConfigs])->with('data', $data);
    }

    public function Charge(Request $request)
    {
        //
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => (int)$request->mount*100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "TuneBump App",
        ]);
    
        // $creidt = Prices::where('name', 'rate')->first();

        $transactions = new Transactions();
        $transactions->userId = $request->user()->id;
        $transactions->paypal = 'strip';
        $transactions->amount = $request->mount;
        $transactions->description = $request->credit;
        $transactions->status = 'Paid';
        $transactions->save();

        $credits = Credits::where('userId', $request->user()->id)->first();
        $credits->credits += $request->credit;
        $credits->save();
   
        Session::flash('success', 'Payment Success!');
           
        return back();
        
    }
}