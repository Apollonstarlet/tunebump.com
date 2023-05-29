{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Forget Password')

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
      <section class="w-full px-8 py-16 bg-white xl:px-8">
          <div class="max-w-xl mx-auto">
              <div class="flex flex-col items-center md:flex-row">
                  <div class="w-full mt-16 md:mt-0">
                      <div class="relative z-10 h-auto p-8 py-10 overflow-hidden bg-white  border-gray-300 rounded-lg border border-gray-100 px-7">
                          <h3 class="mb-6 text-1xl font-medium text-gray-600 text-center">Enter your registered email address. You'll receive an email with a password reset link.</h3>
                           @if (session('status'))
                            <div style="margin: 15px 0;"><h6 style="color: green;">{{ session('status') }}</h6></div>
                            @endif
                            @error('email')
                              <div style="margin: 15px 0;"><h6 style="color: red;">{{ $message }}</h6></div>
                            @enderror
                          <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <input type="email" name="email" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="Email address">
                            <div class="block">
                                <button type="submit" class="w-full px-3 py-4 font-medium text-white bg-blue-600 rounded-lg">Continue</button>
                            </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
    </div>
  </section>

  @include('panels.foot')
@endsection