{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Reset Password')

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
                          <h3 class="mb-6 text-1xl font-medium text-gray-600 text-center">Reset Password</h3>
                            @error('email')
                              <div style="margin: 15px 0;"><h6 style="color: red;">{{ $message }}</h6></div>
                            @enderror
                          <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="email" name="email" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" value="{{ $email ?? old('email') }}">
                            <input type="password" name="password" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="New password">
                            <input type="password" name="password_confirmation" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="Confirm password">
                            <div class="block">
                                <button type="submit" class="w-full px-3 py-4 font-medium text-white bg-blue-600 rounded-lg">Reset</button>
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