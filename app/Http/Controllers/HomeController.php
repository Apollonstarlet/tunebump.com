<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.client.home');
    }
	
    public function rechargePage()
    {
        return view('pages.client.recharge');
    }
	
    public function withdrawPage()
    {
        return view('pages.client.withdraw');
    }
	
    public function financialPage()
    {
        return view('pages.client.financial');
    }
	
    public function messagePage()
    {
        return view('pages.client.message');
    }

    public function orderPage()
    {
        return view('pages.client.order');
    }

    public function onlinePage()
    {
        return view('pages.client.online');
    }

    public function settingPage()
    {
        return view('pages.client.setting');
    }

    public function helpPage()
    {
        return view('pages.client.help');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('pages.admin.home');
    }
}
