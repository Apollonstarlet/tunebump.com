{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Login for Artist')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-12 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
      <div class="mx-auto max-w-7xl">
          @include('panels.nav')
          <!-- Section 2 -->
          <section class="relative flex items-center justify-center w-full h-full bg-white">
            <div class="relative hidden w-1/4 h-full bg-center bg-cover lg:block"></div>
            <div class="absolute top-0 left-0 hidden w-1/4 h-full bg-center bg-cover rounded lg:block" style="background-image:url('images/sign-in-image.jpg')">
        
                <a href="{{ asset('/')}}" class="absolute bottom-0 left-0 flex items-center w-auto m-5 font-medium text-white group">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    Return Home
                    <span class="absolute overflow-hidden left-0 block pl-5 h-0.5 w-full bottom-0 -mb-0.5">
                        <span class="absolute rounded-full bg-white duration-200 ease-in-out transition-all h-0.5 w-0 group-hover:w-full"></span>
                    </span>
                </a>
            </div>
        
            <div class="flex items-center justify-center w-full h-full px-8 py-20 lg:w-3/4 sm:px-0">
                <div class="w-full max-w-sm mx-auto">
                    <h1 class="text-gray-600 font-medium text-2xl border-b border-gray-300 pb-2.5 mb-2.5">Artist login</h1>
                    <p class="mb-10 text-gray-500">Need an account? <a href="{{ route('register') }}" class="ml-1 font-medium text-blue-600">Create one here</a></p>
                   <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf    
                    <div class="relative flex flex-col-reverse mb-5">
                        <input type="email" name="email" class="border-gray-300 focus:border-blue-600 peer border rounded-md px-3.5 py-3 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-600 focus:ring-opacity-0 caret-blue-600" placeholder="Email Address">
                        <label for="email" class="mb-2 font-medium text-gray-500 peer-focus:text-blue-600">Email</label>
                    </div>
                    @error('email')
                    <div style="margin: 15px 0;">
                        <h6 style="color: red;">{{ $message }}</h6>
                    </div>
                    @enderror 
                    <div class="relative flex flex-col-reverse mb-5">
                        <input type="password" name="password" class="peer border-gray-300 focus:border-blue-600 border rounded-md px-3.5 py-3 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-600 focus:ring-opacity-0 caret-blue-600" placeholder="Password">
                        <label for="password" class="mb-2 font-medium text-gray-500 peer-focus:text-blue-600">Password</label>
                    </div>
                    @error('password')
                    <div style="margin: 15px 0;">
                        <h6 style="color: red;">{{ $message }}</h6>
                    </div>
                    @enderror 
                    <div class="flex items-center justify-between mb-5">
                        <div class="relative flex items-center space-x-2 text-gray-500">
                            <input type="checkbox" class="p-2 border border-gray-300 rounded form-checkbox peer focus:border-gray-300 active:border-gray-300 checked:bg-blue-600 checked:border-blue-600" name="remember">
                            <span class="block peer-checked:text-gray-700">Keep me logged in</span>
                        </div>
                        <a href="{{ route('password.request') }}" class="ml-2 font-medium text-blue-600">Forgot Password</a>
                    </div>
        
                    <div class="relative flex flex-col">
                        <button type="submit" class="w-full rounded bg-blue-600 hover:opacity-90 text-white py-3.5 px-2 text-center font-medium">Sign in</button>
                    </div>
                  </form>
                </div>
            </div>
          </section>
      </div>
  </section>

  @include('panels.foot')
  
@endsection