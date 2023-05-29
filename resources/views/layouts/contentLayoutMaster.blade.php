<!DOCTYPE html>
<html class="loading"
  lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{'en'}}@endif"
  data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}">
<!-- BEGIN: Head-->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title> {{env('APP_NAME')}} | @yield('title')</title>
  <link rel="apple-touch-icon" href="{{asset('images/favicon/apple-touch-icon-152x152.png')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon/favicon-32x32.png')}}">

  {{-- Include core + vendor Styles --}}
  @include('panels.styles')

</head>
@include('layouts.verticalLayoutMaster')
<!-- END: Head-->
</html>