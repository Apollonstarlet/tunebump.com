{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','For Artists')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-3 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
    <div class="mx-auto max-w-7xl">
      @include('panels.nav')
        <!-- content start -->
        <section class="h-auto bg-white">
            <div class="max-w-5xl mx-auto py-16 px-10 pt-12 pb-12 sm:px-6 lg:px-8">
                <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">For artists</h2>
                <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-4xl">Promote music</p>
                <p class="mt-5 mx-auto text-gray-500">
                    Spotify playlists have become an increasingly important way for music artists to reach new listeners and promote their music. In fact, many artists have found success simply by getting their music added to popular Spotify playlists.
                </p>
                <br>
                <p class="mx-auto text-gray-500">One reason for the growing popularity and influence of Spotify playlists is the rise of streaming services. With over 345 million users, Spotify is the world's most popular music streaming service, and the platform's personalized playlists have become a key way for artists to get their music heard by a wide audience. it's easier than ever for people to discover new music through curated playlists.</p>
                
                <div>
                    <p class=" mt-12 text-2xl font-extrabold text-gray-600 sm:text-3xl sm:tracking-tight lg:text-2xl">How it works</p>
                        <p class="text-gray-500 py-3">1. Create an account. Go to <a href="https://tunebump.com/artist-register" class="text-blue-600">Artist Signup</a> and enter your email address, username, and password.</p>
                        <p class="text-gray-500 py-3">2. To submit a song to a curator on Tunebump, music artists need to pay 20 credits, which is equal to $2. To purchase these credits, simply go to the "credits" page on Tunebump and follow the instructions provided. You can purchase credits using credit card or PayPal.</p>
                        <p class="text-gray-500 py-3">3. Once you have logged in, you can purchase credits. and submit your music to the curators. Click on the "Submit a “song button’ and fill out the form. You will need to enter the url to your song on Spotify, select your genres and choose the amount of curators that you would like to review your song. </p>
                        <p class="text-gray-500 py-3">4. Submit your song and wait for reviews from the curators. They will listen to your music and provide feedback on whether they like it or not. If they like your music, they may add it to their playlist(s).</p>
                        <p class="text-gray-500 py-3">5. You will receive an e-mail notification from Tunebump every time a curator has reviewed your song.</p>
                        <p class="text-gray-500 py-3">6. If all the curators have not left feedback within 7 days, you can cancel your promotion and receive a refund for the incomplete reviews. The credits you used for the incomplete submissions will be returned to your account balance.</p>
                </div>
                    
                    
                </div>
                    
                </div>
        </section>
        <!-- end title -->
        <!-- Section 1 -->

    </div>
</section>

  @include('panels.foot')
@endsection