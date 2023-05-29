{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','For Curators')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-3 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
    <div class="mx-auto max-w-7xl">
      @include('panels.nav')
        <!-- title -->
        <section class="h-auto bg-white">
            <div class="max-w-5xl mx-auto py-16 px-10 pt-12 pb-12 sm:px-6 lg:px-8">
                <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">For curators</h2>
                <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-4xl">Review and earn</p>
                <p class="mt-5 mx-auto  text-gray-500">
                    The music world has digitised and with it the way music is promoted. Spotify playlists have become popular instruments for artists and labels to get music listened to. By getting placed on Spotify playlists, songs get a lot more listeners. 
                    Tunebump serves as a bridge between artists and playlist curators. On our platform, artists can easily send their music to playlist curators. Based on selected genres, music is sent to playlist curators with similar genres. The playlist curator listens to the song and decides whether to add it to a playlist. 
                </p>
                
                <div>
                    <p class=" mt-12 text-2xl font-extrabold text-gray-600 sm:text-3xl sm:tracking-tight lg:text-2xl">How to join</p>
                    <p class="mx-auto mt-0 text-gray-500">
                        <p class="text-gray-500">1. Go to <a href="https://tunebump.com/curator-login" class="text-blue-600">Curator login</a> and click on Sign in with Spotify.</p>
                        <p class="text-gray-500">2. Sign in with your Spotify account</p>
                        <p class="text-gray-500">3. After logging in, go to the Playlists page.</p>
                        <p class="text-gray-500">4. Click on Add new playlist to add your playlist(s) to your account.</p>
                        
                    <p class="text-gray-500 mt-6">
                        Your submitted playlists will be reviewed by us. On the Playlists page you can see the status of your submitted playlist. After we have accepted your playlist you will start receiving song submissions.
                        Curators currently earn $1.00 (10 credits) for every completed review. You can withdraw your earnings via PayPal. 
                    </p>    
                
                </div>
                    <p class=" mt-12 text-2xl font-extrabold text-gray-600 sm:text-3xl sm:tracking-tight lg:text-2xl">Requirements</p>    
                    
                    <p class="text-gray-500 mb-6">
                        Once you have received a new submission, you must review the song by clicking the review button. In order to provide our service and quality to artists, it is important that you follow the guidelines below.
                    </p>   
                    
                    <div>
                        <il>
                            <li class="text-gray-500">Listen to the song, preferably in full;</li>
                            <li class="text-gray-500">Consider songs for placement in your playlist(s);</li>
                            <li class="text-gray-500">Write useful/helpful feedback that explains why you did or did not like a song;</li>
                            <li class="text-gray-500">You need to have at least 500 playlist followers;</li>
                            <li class="text-gray-500">Your playlist needs to have active and real listeners.</li>
                        </il>    
                    </div>    
                   
                <div>
                    
                    
                    
                </div>
                    
                </div>
        </section>
        <!-- end title -->
        <!-- Section 1 -->

    </div>
</section>

  @include('panels.foot')
@endsection