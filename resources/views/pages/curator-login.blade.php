{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Login for Curator')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-12 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
      <div class="mx-auto max-w-7xl">
        @include('panels.nav')
        <!-- Section 1 -->
        <input id="redirect" type="hidden" value="{{ env('SPOTIFY_REDIRECT') }}">
        <input id="client_id" type="hidden" value="{{ env('SPOTIFY_CLIENT_ID') }}">
        <input id="client_secret" type="hidden" value="{{ env('SPOTIFY_CLIENT_SECRET') }}">
        <section class="relative flex items-center justify-center w-full h-full bg-white">
            <div class="relative hidden w-1/4 h-full bg-center bg-cover lg:block"></div>
            <div class="absolute top-0 left-0 hidden w-1/4 h-full rounded bg-center bg-cover lg:block" style="background-image:url('images/mockups.jpg')">
                <div class="absolute inset-0 w-full h-full bg-gradient-to-b from-transparent rounded to-gray-900"></div>
                <a href="{{ asset('/')}}" class="absolute bottom-0 left-0 flex items-center w-auto m-5 font-medium text-white group">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    Return Home
                    <span class="absolute overflow-hidden left-0 block pl-5 h-0.5 w-full bottom-0 -mb-0.5">
                        <span class="absolute rounded-full bg-white duration-200 ease-in-out transition-all h-0.5 w-0 group-hover:w-full"></span>
                    </span>
                </a>
            </div>

            <div class="flex items-center justify-center w-full h-full px-8 pt-20 pb-10 lg:w-3/4 sm:px-0">
                <div class="w-full max-w-sm mx-auto">
                    <h1 class="text-gray-600 font-medium text-2xl border-b border-gray-300 pb-2.5 mb-2.5">Login as a curator</h1>
                    <p class="mb-10 text-gray-500 text-sm">We pay you review tracks and write feedback. To join as a curator, you need to own a playlist with at least <u>500 followers.</u></p>

                    <div class="flex items-center justify-between mb-5">
                    <div class="relative flex flex-col">
                      <a  id="authorization" class="w-full flex items-center shadow justify-center rounded bg-blue-600 hover:bg-blue-700 cursor-pointer border border-gray-300 text-white py-3.5 px-2 text-center font-medium">
                          <img src="{{ asset('images/spotify.png')}}" class="w-5 h-5">
                          <span class="ml-2.5">Sign in with Spotify</span>
                      </a>
                        <span class="relative w-full mb-32 py-4 text-sm text-center text-gray-600">By signing in, you agree to Tunebump's terms of use & service.</span>

                    </div>
                </div>
            </div>
        </section>
      </div>
  </section>

  @include('panels.foot')
  <script src="{{asset('js/vendors.min.js')}}"></script>
  <script>
    (function($) {
      var redirect_uri  = $('input#redirect').val(); // change this your value
      var client_id     = $('input#client_id').val(); 
      var client_secret = $('input#client_secret').val(); // In a real app you should not expose your client_secret to the user
    
      const AUTHORIZE = "https://accounts.spotify.com/authorize"
    
      $('a#authorization').click(function(e){
        localStorage.setItem("redirect_uri", redirect_uri);
        localStorage.setItem("client_id", client_id);
        localStorage.setItem("client_secret", client_secret); // In a real app you should not expose your client_secret to the user
        console.log(redirect_uri);
        let url = AUTHORIZE;
        url += "?client_id=" + client_id;
        url += "&response_type=code";
        url += "&redirect_uri=" + encodeURI(redirect_uri);
        url += "&show_dialog=true";
        url += "&scope=user-read-private user-read-email";
        window.location.href = url; // Show Spotify's authorization screen
      });
    })(window.jQuery);
  </script>
  
@endsection