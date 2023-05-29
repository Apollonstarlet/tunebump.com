{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Home')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-3 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
    <div class="mx-auto max-w-7xl">
      @include('panels.nav')
      <div class="relative z-30 flex flex-col px-10 pt-6 pb-14 mx-auto md:flex-row sm:pt-15 sm:pb-14 md:pt-20 md:pb-14 max-w-7xl">
          <div class="flex flex-col items-start justify-center py-6 w-full md:w-1/2 sm:pr-8 xl:pr-32">
              <h1 class="text-3xl text-blue-600 font-bold lg:text-6xl xl:text-6xl">Connect with</h1>
              <h1 class="text-3xl text-gray-600 font-bold lg:text-6xl xl:text-6xl">Playlist curators</h1>

            <p class="py-5 text-gray-500">Tunebump allows music publishers to submit their tracks to Spotify playlist curators and receive feedback.</p>

            <div class="w-full h-auto">
              <div class="w-full h-auto flex flex-col-reverse mb-2">
                    <a href="{{ asset('register')}}" class="items-center py-3 mr-1 text-base font-semibold text-white no-underline text-center bg-blue-600 border border-transparent border-solid rounded-md cursor-pointer select-none sm:mb-0 sm:w-auto hover:bg-blue-500 hover:border-blue-500 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700">
                      Create account</a>
              </div>

              
            </div>
            
            <div class="w-full h-auto">
              <div class="w-full h-auto flex flex-col-reverse mb-2">
                    <a href="{{ asset('login')}}" class="items-center py-3 mr-1 text-base font-semibold text-gray-600 no-underline text-center border border-gray-300 border-solid rounded-md cursor-pointer select-none sm:mb-0 sm:w-auto hover:bg-gray-50 hover:border-gray-300 hover:text-black focus-within:bg-blue-700 focus-within:border-blue-700">
                      Sign in</a>
              </div>

              
            </div>
            
        </div>
          <div class="relative flex items-center justify-center w-full md:mt-0 md:w-1/2">
              <div>
                  <img src="{{ asset('https://i.imgur.com/2gGQZLI.png')}}" class="rounded-lg">
              </div>
          </div>
      </div>


  </section>


  <!-- Section 1 -->
  <section class="mx-auto max-w-7xl bg-transparent border border-gray-200 py-15 overflow-hidden relative">
      <div class="absolute left-0 bottom-0 w-48 h-48 -ml-24 -mb-24 rounded-full bg-blue-600"></div>
      <div class="absolute right-0 p-1 top-0 w-96 h-96 translate-x-1/2 -translate-y-1/2 -mt-20 flex items-center justify-center rounded-full">
          <div class="w-full h-full relative rounded-full"></div>
      </div>
          <h2 class="w-full m-0 text-4xl mt-10 tracking-wide text-center border-0 border-gray-200 sm:text-5xl">How it works</h2>
      <div class="flex flex-col items-center max-w-6xl px-8 py-16 mx-auto leading-6 border-solid md:items-stretch md:justify-center md:py-13">
          <div class="grid grid-cols-3 gap-5 sm:grid-cols-8 lg:grid-cols-12">
              <div class="max-w-xs col-span-4 font-sans border-0 border-gray-200 text-gray-50">
                  <div class="box-border flex flex-col items-center h-full px-2 py-8 mx-4 leading-6 text-center border-solid sm:items-start sm:text-left">
                      <span class="flex-shrink-0 p-5 font-sans border-0 border-gray-200 rounded-full bg-blue-600 text-gray-50">
                          <img src="{{ asset('images/music-note-white.png')}}" class="w-8 h-8 text-black">
                      </span>
                      <div class="mt-6 font-sans text-center border-0 border-gray-200 sm:text-left text-gray-50">
                          <span class="box-border text-xl font-semibold tracking-wider border-solid text-gray-700">Create a promotion</span>
                          <p class="box-border text-gray-500 mx-0 mt-2 mb-0 font-normal leading-loose text-center text-black leading-loose border-solid sm:text-left">Upload your track, select genres and choose how many playlist curators you want to reach.</p>
                      </div>
                  </div>
              </div>

              <div class="max-w-xs col-span-4 font-sans border-0 border-gray-200 text-gray-50">
                  <div class="box-border flex flex-col items-center h-full px-2 py-8 mx-4 leading-6 text-center border-solid sm:items-start sm:text-left">
                      <span class="flex-shrink-0 p-5 font-sans border-0 border-gray-200 rounded-full bg-blue-600 text-gray-50">
                          <img src="{{ asset('images/mail-white.png')}}" class="w-8 h-8 text-black">
                      </span>
                      <div class="mt-6 font-sans text-center border-0 border-gray-200 sm:text-left text-gray-50">
                          <span class="box-border text-xl font-semibold tracking-wider text-center border-solid sm:text-left text-gray-700">Submit to curators</span>
                          <p class="box-border text-gray-500 mx-0 mt-2 mb-0 font-normal leading-loose text-center text-black leading-loose border-solid sm:text-left">Your song is sent to Spotify playlist curators with matching genres and at least 500 playlist followers.</p>
                      </div>
                  </div>
              </div>

              <div class="max-w-xs col-span-4 font-sans border-0 border-gray-200 text-gray-50">
                  <div class="box-border flex flex-col items-center h-full px-2 py-8 mx-4 leading-6 text-center border-solid sm:items-start sm:text-left">
                      <span class="flex-shrink-0 p-5 font-sans border-0 border-gray-200 rounded-full bg-blue-600 text-gray-50">
                          <img src="{{ asset('images/star-white.png')}}" class="w-8 h-8 text-black">
                      </span>
                      <div class="mt-6 font-sans text-center border-0 border-gray-200 sm:text-left text-gray-50">
                          <span class="box-border text-xl font-semibold tracking-wider text-center border-solid sm:text-left text-gray-700">Feedback</span>
                          <p class="box-border text-gray-500 mx-0 mt-2 mb-0 font-normal leading-loose text-center text-black leading-loose border-solid sm:text-left">Playlist curators will listen to your track, write feedback and add your song to their playlist if they like it. </p>
                      </div>
                  </div>
              </div>
  </section>

<!-- Section 2 -->
<section class="relative bg-white">
    <div class="max-w-2xl lg:max-w-7xl px-12 mx-auto">
        <div class="flex justify-center lg:flex-row pb-5 xl:pb-16 mt-10 mb-10 flex-col-reverse items-center">
            <div class="w-full lg:w-1/2 lg:px-0 mb-16 lg:mb-0">
                <div class="w-full h-full bg-gradient-to-br shadow-sm border-b-4 border-r-4 border-pink-200 from-red-100 to-pink-200 p-20 pb-0 rounded-2xl">
                    <img class="rounded-lg" src="{{ asset('images/Tunebump-campaigns.png')}}">
                </div>
            </div>
            <div class="w-full lg:w-1/2 mb-16 pt-5 ml-0 sm:px-5 sm:pl-8 xl:pl-20 lg:mb-0">
                <h1 class="w-full m-0 text-4xl mt-10 tracking-wide border-0 border-gray-200 sm:text-5xl text-black">Why Tunebump?</h1>
                <div class="relative">
                    <div class="flex mb-6 mt-12">
                        <svg class="w-8 h-8 -mt-0.5 flex-shrink-0 mr-3 xl:mr-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <div class="max-w-md lg:max-w-sm">
                            <h3 class="mb-2 -mt-1 text-xl md:text-xl">Affordable pricing</h3>
                            <p class="text-gray-500 leading-loose">A submission to a curator costs $2.00, and a portion of the fee is used to compensate and motivate the curators to review your music.</p>
                        </div>
                    </div>
                    <div class="flex mb-6">
                        <svg class="w-8 h-8 -mt-0.5 flex-shrink-0 mr-3 xl:mr-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <div class="max-w-md lg:max-w-sm">
                            <h3 class="mb-2 -mt-1 text-xl md:text-xl">Easy to use</h3>
                            <p class="text-gray-500 leading-loose">Our system will automatically send your track to playlist curators that have matching genres. You will get notified by e-mail when you have received a new review.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <svg class="w-8 h-8 -mt-0.5 flex-shrink-0 mr-3 xl:mr-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <div class="max-w-md lg:max-w-sm">
                            <h3 class="mb-2 -mt-1 text-xl md:text-xl">Guaranteed feedback</h3>
                            <p class="text-gray-500 leading-loose">If your playlist campaign is still active after 7 days, you can cancel your campaign and receive a refund for the incomplete reviews. The credits will be returned to your balance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section

<section class="bg-white">
    <div class="px-8 py-8 mx-auto max-w-7xl">
        <div class="relative px-6 py-10 overflow-hidden border border-blue-100 rounded-2xl lg:p-16 lg:flex lg:flex-col lg:items-center lg:justify-between">

            <!-- Left Pattern -->
            <div class="absolute top-0 left-0 z-10 hidden h-full p-4 mt-1 ml-3 -mt-4 -ml-4 transform -rotate-90 lg:block">
                <svg class="w-auto h-full fill-current text-blue-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 390 390"><defs></defs><g fill-rule="nonzero"><circle cx="10" cy="10" r="9.5"></circle><circle cx="47" cy="10" r="9.5"></circle><circle cx="84" cy="10" r="9.5"></circle><circle cx="121" cy="10" r="9.5"></circle><circle cx="158" cy="10" r="9.5"></circle><circle cx="195" cy="10" r="9.5"></circle><circle cx="232" cy="10" r="9.5"></circle><circle cx="269" cy="10" r="9.5"></circle><circle cx="306" cy="10" r="9.5"></circle><circle cx="343" cy="10" r="9.5"></circle><circle cx="380" cy="10" r="9.5"></circle><circle cx="47" cy="47" r="9.5"></circle><circle cx="84" cy="47" r="9.5"></circle><circle cx="121" cy="47" r="9.5"></circle><circle cx="158" cy="47" r="9.5"></circle><circle cx="195" cy="47" r="9.5"></circle><circle cx="232" cy="47" r="9.5"></circle><circle cx="269" cy="47" r="9.5"></circle><circle cx="306" cy="47" r="9.5"></circle><circle cx="343" cy="47" r="9.5"></circle><circle cx="380" cy="47" r="9.5"></circle><circle cx="84" cy="84" r="9.5"></circle><circle cx="121" cy="84" r="9.5"></circle><circle cx="158" cy="84" r="9.5"></circle><circle cx="195" cy="84" r="9.5"></circle><circle cx="232" cy="84" r="9.5"></circle><circle cx="269" cy="84" r="9.5"></circle><circle cx="306" cy="84" r="9.5"></circle><circle cx="343" cy="84" r="9.5"></circle><circle cx="380" cy="84" r="9.5"></circle><circle cx="121" cy="121" r="9.5"></circle><circle cx="158" cy="121" r="9.5"></circle><circle cx="195" cy="121" r="9.5"></circle><circle cx="232" cy="121" r="9.5"></circle><circle cx="269" cy="121" r="9.5"></circle><circle cx="306" cy="121" r="9.5"></circle><circle cx="343" cy="121" r="9.5"></circle><circle cx="380" cy="121" r="9.5"></circle><circle cx="158" cy="158" r="9.5"></circle><circle cx="195" cy="158" r="9.5"></circle><circle cx="232" cy="158" r="9.5"></circle><circle cx="269" cy="158" r="9.5"></circle><circle cx="306" cy="158" r="9.5"></circle><circle cx="343" cy="158" r="9.5"></circle><circle cx="380" cy="158" r="9.5"></circle><circle cx="195" cy="195" r="9.5"></circle><circle cx="232" cy="195" r="9.5"></circle><circle cx="269" cy="195" r="9.5"></circle><circle cx="306" cy="195" r="9.5"></circle><circle cx="343" cy="195" r="9.5"></circle><circle cx="380" cy="195" r="9.5"></circle><circle cx="232" cy="232" r="9.5"></circle><circle cx="269" cy="232" r="9.5"></circle><circle cx="306" cy="232" r="9.5"></circle><circle cx="343" cy="232" r="9.5"></circle><circle cx="380" cy="232" r="9.5"></circle><circle cx="269" cy="269" r="9.5"></circle><circle cx="306" cy="269" r="9.5"></circle><circle cx="343" cy="269" r="9.5"></circle><circle cx="380" cy="269" r="9.5"></circle><circle cx="306" cy="306" r="9.5"></circle><circle cx="343" cy="306" r="9.5"></circle><circle cx="380" cy="306" r="9.5"></circle><circle cx="343" cy="343" r="9.5"></circle><circle cx="380" cy="343" r="9.5"></circle><circle cx="380" cy="380" r="9.5"></circle></g></svg>
            </div>

            <!-- Right Pattern -->
            <div class="absolute bottom-0 right-0 z-10 hidden h-full p-4 mt-1 ml-3 -mb-4 -mr-4 transform rotate-90 md:block">
                <svg class="w-auto h-full fill-current text-blue-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 390 390"><defs></defs><g fill-rule="nonzero"><circle cx="10" cy="10" r="9.5"></circle><circle cx="47" cy="10" r="9.5"></circle><circle cx="84" cy="10" r="9.5"></circle><circle cx="121" cy="10" r="9.5"></circle><circle cx="158" cy="10" r="9.5"></circle><circle cx="195" cy="10" r="9.5"></circle><circle cx="232" cy="10" r="9.5"></circle><circle cx="269" cy="10" r="9.5"></circle><circle cx="306" cy="10" r="9.5"></circle><circle cx="343" cy="10" r="9.5"></circle><circle cx="380" cy="10" r="9.5"></circle><circle cx="47" cy="47" r="9.5"></circle><circle cx="84" cy="47" r="9.5"></circle><circle cx="121" cy="47" r="9.5"></circle><circle cx="158" cy="47" r="9.5"></circle><circle cx="195" cy="47" r="9.5"></circle><circle cx="232" cy="47" r="9.5"></circle><circle cx="269" cy="47" r="9.5"></circle><circle cx="306" cy="47" r="9.5"></circle><circle cx="343" cy="47" r="9.5"></circle><circle cx="380" cy="47" r="9.5"></circle><circle cx="84" cy="84" r="9.5"></circle><circle cx="121" cy="84" r="9.5"></circle><circle cx="158" cy="84" r="9.5"></circle><circle cx="195" cy="84" r="9.5"></circle><circle cx="232" cy="84" r="9.5"></circle><circle cx="269" cy="84" r="9.5"></circle><circle cx="306" cy="84" r="9.5"></circle><circle cx="343" cy="84" r="9.5"></circle><circle cx="380" cy="84" r="9.5"></circle><circle cx="121" cy="121" r="9.5"></circle><circle cx="158" cy="121" r="9.5"></circle><circle cx="195" cy="121" r="9.5"></circle><circle cx="232" cy="121" r="9.5"></circle><circle cx="269" cy="121" r="9.5"></circle><circle cx="306" cy="121" r="9.5"></circle><circle cx="343" cy="121" r="9.5"></circle><circle cx="380" cy="121" r="9.5"></circle><circle cx="158" cy="158" r="9.5"></circle><circle cx="195" cy="158" r="9.5"></circle><circle cx="232" cy="158" r="9.5"></circle><circle cx="269" cy="158" r="9.5"></circle><circle cx="306" cy="158" r="9.5"></circle><circle cx="343" cy="158" r="9.5"></circle><circle cx="380" cy="158" r="9.5"></circle><circle cx="195" cy="195" r="9.5"></circle><circle cx="232" cy="195" r="9.5"></circle><circle cx="269" cy="195" r="9.5"></circle><circle cx="306" cy="195" r="9.5"></circle><circle cx="343" cy="195" r="9.5"></circle><circle cx="380" cy="195" r="9.5"></circle><circle cx="232" cy="232" r="9.5"></circle><circle cx="269" cy="232" r="9.5"></circle><circle cx="306" cy="232" r="9.5"></circle><circle cx="343" cy="232" r="9.5"></circle><circle cx="380" cy="232" r="9.5"></circle><circle cx="269" cy="269" r="9.5"></circle><circle cx="306" cy="269" r="9.5"></circle><circle cx="343" cy="269" r="9.5"></circle><circle cx="380" cy="269" r="9.5"></circle><circle cx="306" cy="306" r="9.5"></circle><circle cx="343" cy="306" r="9.5"></circle><circle cx="380" cy="306" r="9.5"></circle><circle cx="343" cy="343" r="9.5"></circle><circle cx="380" cy="343" r="9.5"></circle><circle cx="380" cy="380" r="9.5"></circle></g></svg>
            </div>

            <h3 class="relative z-20 mb-4 -mt-1 text-4xl font-bold text-blue-900">Do you curate playlists on Spotify?</h3>
            <p class="relative z-20 mb-6 text-lg text-blue-700">Join us, review new music and earn money.</p>
            <div class="relative z-20 flex flex-col items-center w-full space-y-5 md:space-x-5 md:space-y-0 md:flex-row md:w-auto lg:flex-shrink-0 md:px-0">
                <a href="{{ asset('curator-login')}}" class="block w-full px-5 py-3 text-base font-medium leading-6 text-center text-white transition duration-150 ease-in-out bg-blue-600 rounded-md md:inline-flex md:shadow-sm md:w-auto hover:bg-blue-500 focus:outline-none focus:shadow-outline">Join now</a>

            </div>

        </div>
    </div>
</section>

  @include('panels.foot')
  <script src="{{asset('js/preload.min.js')}}"></script>
  <script>
      var currenturl = window.location.href;
       if(currenturl.indexOf("http://") != -1){
           currenturl = currenturl.replace("http://", "https://");
           window.location.replace(encodeURI(currenturl));
       }
  </script>
@endsection