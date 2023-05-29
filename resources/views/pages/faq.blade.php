{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','FAQ')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-3 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
    <div class="mx-auto max-w-7xl">
      @include('panels.nav')
      <!-- Section 1 -->
        <section class="relative py-16 bg-white min-w-screen animation-fade animation-delay">
            <div class="container px-0 px-8 mx-auto sm:px-12 xl:px-5">
                <p class="text-xs font-bold text-left uppercase sm:mx-6 sm:text-center sm:text-normal sm:font-bold text-blue-600">
                    Got a Question? We’ve got answers.
                </p>
                <h3 class="mt-1 text-2xl font-bold text-left text-gray-800 sm:mx-6 sm:text-3xl md:text-4xl lg:text-5xl sm:text-center sm:mx-0">
                    Frequently Asked Questions
                </h3>
                <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">What is Tunebump?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                        Tunebump is a platform that connects music publishers with playlist curators on Spotify, allowing them to promote their music to a wider audience.
                    </p>
                </div>
                <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">How does it work?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                      Music publishers can upload their tracks to Tunebump and select the genres of their music. Tunebump then shows them available curators who have playlists in the same genres, and they can submit their tracks to these curators.
                    </p>
                </div>
                
                <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">How much does it cost to use Tunebump?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                      Each submission to a curator costs 20 credits. Credits can be purchased on Tunebump's website, and the cost depends on the package selected.
                    </p>
                </div>
                
              -   <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">What happens after I submit my track to a curator?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                     Curators will review your track and decide whether to include it in their playlist. Tunebump will notify you via email once your track has been reviewed.
                    </p>
                </div>
                
                <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">How many curators can I submit my track to?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                      You can submit your track to as many curators as are available, but each submission will cost 20 credits.
                    </p>
                </div>
                
                              -   <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">Can I track the progress of my campaigns?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                      Yes, Tunebump provides a promotions page where you can track the progress of your submissions and read feedback from curators.
                    </p>
                </div>
                
                              -   <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">Does Tunebump guarantee that my track will be added to a playlist by a curator?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                      Tunebump cannot guarantee that your track will be added to a playlist by a curator as they have complete creative freedom to decide whether or not to include a track. This means that curators have different tastes and preferences when it comes to adding tracks to their playlists, and some may not feel that your track fits their playlist's theme or style, while others may prefer to feature tracks by different artists. Therefore, the decision to include a track ultimately rests with the curator, and Tunebump cannot guarantee the outcome.
                    </p>
                </div>
                
                
                <div class="w-full px-6 py-6 mx-auto mt-10 bg-white border border-gray-200 rounded-lg sm:px-8 md:px-12 sm:py-8 sm:shadow lg:w-5/6 xl:w-2/3">
                    <h3 class="text-lg font-bold sm:text-xl md:text-2xl text-blue-600">Is the promotion safe?</h3>
                    <p class="mt-2 text-base text-gray-600 sm:text-lg md:text-normal">
                      Yes. Curators are thoroughly reviewed before being approved to join our platform. We make sure the playlists have real, organic listeners.
In addition to that, Tunebump does not break any Spotify terms and conditions because we do not pay our curators for guaranteed placements. We reach out to curators and pay them to listen to your music and write feedback. Whether a playlist gets placement is entirely up to them.
                    </p>
                </div>
                
            </div>
        </section>
    </div>
  </section>

  @include('panels.foot')
@endsection