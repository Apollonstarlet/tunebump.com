{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Login')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-12 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
      <div class="mx-auto max-w-7xl">
          @include('panels.nav')
      </div>
  </section>
  <section class="relative block w-full pb-10 overflow-hidden leading-6 text-left text-gray-800 bg-white">
    <div class="w-full px-8 mx-auto leading-6 text-left xl:px-12 max-w-7xl">
        <div class="flex flex-wrap justify-center -mx-4 text-center text-gray-800">
            <div class="relative w-full px-4 leading-6 text-black xl:flex-grow-0 xl:flex-shrink-0 md:flex-grow-0 md:flex-shrink-0 lg:flex-grow-0 lg:flex-shrink-0">
                <h2 class="m-0 text-4xl text-gray-800 font-bold text-center">Choose account</h2>
                <div class="mt-2 mb-2 text-center text-gray-700">Do you release music or are you a playlist curator?</div>
            </div>
        </div>
        <div class="relative flex block w-full max-w-4xl mx-auto mt-16 text-indigo-900 select-none">
            <!-- Start Pricing Plan -->
            <div class="relative left-0 flex flex-col block float-left w-full h-full leading-6 text-left md:flex-row">
                <div class="relative flex items-stretch w-full max-w-md px-4 mx-auto leading-6 text-left md:w-1/2">
                    <div class="absolute top-0 left-0 z-10 flex px-3 py-2 ml-8 -mt-2 text-xs font-medium tracking-wide bg-green-400 rounded-full text-green-50">
                        <img src="{{ asset('images/music-note-white.png')}}" class="w-4 h-4 mr-1 text-white">Promote music
                    </div>
                    <div class="relative pb-12 border-2 border-gray-200 mb-16 overflow-hidden text-gray-800 rounded-lg md:mb-0">
    
                        <img src="" class="block w-auto -mx-px leading-6 text-left align-middle border-none">
                        <div class="px-12 mt-12 leading-6 text-left">
                            <div class="flex flex-wrap justify-between mb-5 text-xl text-gray-800">
                                <div class="text-xl text-left font-semibold">
                                    Artist or Label
                                </div>
                                <div class="text-xl text-left">
                                    <span x-text="basic[billing]"></span>
                                </div>
                            </div>
                            <div class="text-left text-gray-700 text-sm">
                                Submit music to playlist curators and receive useful feedback. You might get added to playlists if curators like your track.
                            </div>
                            <a href="artist-login" class="flex items-center justify-center w-full h-12 px-2 py-1 mt-8 text-base font-normal leading-normal text-center text-white no-underline bg-blue-600 border border-transparent border-solid rounded cursor-pointer select-none hover:bg-blue-700 focus:shadow-xs focus:no-underline">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative flex items-stretch w-full max-w-md px-4 mx-auto leading-6 text-left md:w-1/2">
                  <div class="absolute top-0 left-0 z-10 flex px-3 py-2 ml-8 -mt-2 text-xs font-medium tracking-wide bg-green-400 rounded-full text-green-50">
                        <img src="{{ asset('images/rate-music-white.png')}}" class="w-4 h-4 mr-1 text-white">Review music
                    </div>
                    <div class="pb-12 mb-16 overflow-hidden border-2 border-gray-200 text-indigo-900 rounded-lg md:mb-0">
                        <div src="" class="block w-auto -mx-px leading-6 text-left align-middle border-none"</div>
                        <div class="px-12 mt-12 leading-6 text-left">
                            <div class="flex flex-wrap justify-between mb-5 text-xl text-gray-800">
                                <div class="text-xl text-left font-bold">
                                    Playlist Curator <span x-text="billing"></span>
                                </div>
                                <div class="text-xl text-left">
    
                                </div>
                            </div>
                            <div class="text-left text-gray-700 text-sm">
                                Review new music and get paid to write feedback.
                            </div>
                            <a href="curator-login" class="flex items-center justify-center w-full h-12 px-2 py-1 mt-12 text-base font-normal text-center text-white no-underline align-middle bg-blue-600 border border-gray-300 border-solid rounded cursor-pointer select-none hover:bg-blue-700 focus:shadow-xs focus:no-underline">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Pricing Plans -->
        </div>
    </div>
  <!-- End Max Width Container -->
  </section>

  @include('panels.foot')
  
@endsection