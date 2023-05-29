
<!DOCTYPE html>
<html class="loading"
  lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{'en'}}@endif"
  data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | {{env('APP_NAME')}}</title>
  <link rel="apple-touch-icon" href="{{asset('images/favicon/apple-touch-icon-152x152.png')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon/favicon-32x32.png')}}">

  <!-- Include core + vendor Styles -->
  @include('panels.styles')

</head>
<!-- END: Head-->

<body
  class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns login-bg"
  data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
  <div class="row">
    <div class="col s12">
      <div class="container">
        <!--  main content -->
        @yield('content')
      </div>
      {{-- overlay --}}
      <div class="content-overlay"></div>
    </div>
  </div>
  {{-- vendor scripts and page scripts included --}}
  @include('panels.scripts')

</body>

</html>
