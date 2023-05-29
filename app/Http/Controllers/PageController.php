<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function HomePage(Request $request)
    {
        return view('/pages/home');
    }
    
    public function ErrorPage(Request $request)
    {
        return view('/pages/page-404');
    }
    
    public function ForArtists(Request $request)
    {
        return view('/pages/for-artists');
    }
    
    public function ForCurators(Request $request)
    {
        return view('/pages/for-curator');
    }
    
    public function ArtistLogin(Request $request)
    {
        return view('/pages/artist-login');
    }
    
    public function CuratorLogin(Request $request)
    {
        return view('/pages/curator-login');
    }
    
    public function SupportPage(Request $request){
        return view('/pages/support');
    }
    
    public function FaqPage(Request $request){
        return view('/pages/faq');
    }
    
    public function PrivacyPage(Request $request){
        return view('/pages/privacy');
    }
    
    public function TermsPage(Request $request){
        return view('/pages/terms');
    }

    public function ArtistRegister(Request $request)
    {
        return view('/pages/artist-signup');
    }

    public function Refresh(Request $request)
    {
        return view('/pages/artist-login');
    }
}
