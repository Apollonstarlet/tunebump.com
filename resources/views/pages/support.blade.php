{{-- layout --}}
@extends('layouts.contentLayout')

{{-- page title --}}
@section('title','Contact')

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
  <!-- Section 1 -->
  <section class="w-full px-6 pb-3 antialiased" data-tails-scripts="//unpkg.com/alpinejs">
    <div class="mx-auto max-w-7xl">
      @include('panels.nav')
      <!-- Section 2 -->
        <div class="py-10 bg-white md:py-16">
            <div class="px-10 mx-auto max-w-7xl md:px-16">
                <div class="max-w-3xl mx-auto mb-10 md:mb-16">
                    <p class="text-xs font-bold text-blue-500 uppercase">Contact Us</p>
                    <h2 class="mt-1 text-2xl font-bold text-left text-gray-800 lg:text-3xl md:mt-2">Need to ask us a question?</h2>
                    <p class="max-w-screen-md mx-auto mt-4 text-left text-gray-500 md:text-lg md:mt-6">
                        Fill out the form below and we'll get back to you within 24 hours. You can also reach out to us on <a href="www.instagram.com/tunebump" class="font-medium text-blue-500 underline">Instagram</a>.
                    </p>
                </div>
                <form class="grid max-w-3xl gap-4 mx-auto sm:grid-cols-2">
                    <div>
                        <label for="first-name" class="inline-block mb-2 text-sm font-medium text-gray-500 sm:text-base">First name</label>
                        <input name="first-name" class="w-full px-3 py-2 text-gray-800 transition duration-100 border rounded-md outline-none bg-gray-50 focus:ring ring-blue-300">
                    </div>

                    <div>
                        <label for="last-name" class="inline-block mb-2 text-sm font-medium text-gray-500 sm:text-base">Last name</label>
                        <input name="last-name" class="w-full px-3 py-2 text-gray-800 transition duration-100 border rounded-md outline-none bg-gray-50 focus:ring ring-blue-300">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="company" class="inline-block mb-2 text-sm font-medium text-gray-500 sm:text-base">Company</label>
                        <input name="company" class="w-full px-3 py-2 text-gray-800 transition duration-100 border rounded-md outline-none bg-gray-50 focus:ring ring-blue-300">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="inline-block mb-2 text-sm font-medium text-gray-500 sm:text-base">Email</label>
                        <input name="email" class="w-full px-3 py-2 text-gray-800 transition duration-100 border rounded-md outline-none bg-gray-50 focus:ring ring-blue-300">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="subject" class="inline-block mb-2 text-sm font-medium text-gray-500 sm:text-base">Subject</label>
                        <input name="subject" class="w-full px-3 py-2 text-gray-800 transition duration-100 border rounded-md outline-none bg-gray-50 focus:ring ring-blue-300">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="inline-block mb-2 text-sm font-medium text-gray-500 sm:text-base">Message</label>
                        <textarea name="message" class="w-full h-64 px-3 py-2 text-gray-800 transition duration-100 border rounded-md outline-none bg-gray-50 focus:ring ring-blue-300"></textarea>
                    </div>

                    <div class="flex items-center justify-between sm:col-span-2">
                        <button class="inline-block px-8 py-3 text-sm font-semibold text-center text-white transition duration-100 bg-blue-600 rounded-md outline-none hover:bg-blue-500 active:bg-blue-700 ring-blue-300 md:text-base">Send Message</button>
                    </div>
                </form>
                <p class="max-w-3xl mx-auto mt-5 text-xs text-gray-400">
                    Please allow up to 24-48 hour response during the weekdays.
                </p>
            </div>
        </div>
    </div>
  </section>

  @include('panels.foot')
@endsection