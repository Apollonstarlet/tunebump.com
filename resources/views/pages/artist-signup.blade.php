{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Sign up for Artist')

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
        <section class="py-20 bg-white">
              <div class="px-10 mx-auto max-w-7xl">
                  <div class="flex flex-wrap items-center justify-center">
                      <div class="max-w-sm mb-0 lg:mb-0 lg:max-w-2xl lg:w-1/2 lg:px-4">
                              <img src="{{ asset('images/spotify-logo.png')}}" class="w-auto h-10">
                          </a>
                          <h2 class="mb-4 text-3xl font-bold tracking-tight lg:text-5xl xl:text-6xl">Playlist promotion</h2>
                          <p class="leading-loose text-gray-500 text-sm">Spotify has more than 300 million monthly listeners. By landing on the right Spotify playlists, you can significantly grow your audience and fan base.</p>
                      </div>
                      <div class="w-full px-4 lg:w-1/2">
                          <div class="max-w-sm mx-auto lg:mr-0 lg:ml-auto">
                              <div class="overflow-hidden text-center bg-white rounded-md shadow-sm">
                                  <div class="px-6 py-8">
                                      <form method="POST" action="{{ route('register') }}">
                                       @csrf
                                          <div class="mb-6">
                                              <span class=""></span>
                                              <h4 class="text-2xl font-semibold text-left text-gray-700">Create your account</h4>
                                          </div>
                                          <div class="flex flex-wrap mb-4 -mx-2">
                                              <div class="w-full px-2 mb-4 lg:mb-0 lg:w-1/2">
                                                  <input class="py-2.5 px-4 w-full bg-gray-50 border focus:ring-2 focus:ring-opacity-90 focus:ring-blue-600 border-gray-300 rounded focus:outline-none" type="text" placeholder="First Name" name="firstname">
                                              </div>
                                              <div class="w-full px-2 lg:w-1/2">
                                                  <input class="py-2.5 px-4 w-full bg-gray-50 border focus:ring-2 focus:ring-opacity-90 focus:ring-blue-600 border-gray-300 rounded focus:outline-none" type="text" placeholder="Last Name" name="lastname">
                                              </div>
                                          </div>
                                          <input class="py-2.5 px-4 mb-4 w-full bg-gray-50 border focus:ring-2 focus:ring-opacity-90 focus:ring-blue-600 border-gray-300 rounded focus:outline-none" type="email" placeholder="Email address" name="email">
                                          @error('email')
                                          <div class="flex flex-wrap mb-4 -mx-2">
                                            <div style="margin: 0 15px;">
                                                <h6 style="color: red;">{{ $message }}</h6>
                                            </div>
                                          </div>
                                          @enderror 
                                          <input class="py-2.5 px-4 mb-4 w-full bg-gray-50 border focus:ring-2 focus:ring-opacity-90 focus:ring-blue-600 border-gray-300 rounded focus:outline-none" type="password" placeholder="Enter your password" name="password">
                                          @error('password')
                                          <div class="flex flex-wrap mb-4 -mx-2">
                                            <div style="margin: 0 15px;">
                                                <h6 style="color: red;">{{ $message }}</h6>
                                            </div>
                                          </div>
                                          @enderror 
                                          <input class="py-2.5 px-4 mb-4 w-full bg-gray-50 border focus:ring-2 focus:ring-opacity-90 focus:ring-blue-600 border-gray-300 rounded focus:outline-none" type="password" placeholder="Confirm password" name="password_confirmation">
                                          <button class="w-full py-3 mb-4 font-bold text-white bg-blue-600 rounded hover:bg-blue-600" type="submit">Sign Up</button>
                                      </form>
                                      <p class="text-xs text-gray-400">
                                          <span class="">Already have an account?</span>
                                          <a class="text-blue-600" href="{{ route('login')}}">Sign In</a>
                                      </p>
                                  </div>
                                  <div class="py-2 text-xs font-medium text-gray-400 border-t border-gray-300 bg-white">By signing up, you agree to our <a href="{{ asset('terms')}}" class="text-blue-500 underline">Terms of Service</a></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </section>
    </div>
  </section>

  @include('panels.foot')
@endsection