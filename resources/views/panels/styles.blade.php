<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/vendors.min.css') }}">
<!-- BEGIN: VENDOR CSS-->
@yield('vendor-style')
<!-- END: VENDOR CSS-->
<!-- BEGIN: Page Level CSS-->
<link rel="stylesheet" type="text/css"
  href="{{asset('css/themes/vertical-modern-menu-template/materialize.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('css/themes/vertical-modern-menu-template/style.css')}}">

@yield('page-style')

<!-- END: Page Level CSS-->
<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('css/laravel-custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom/custom.css')}}">
<!-- END: Custom CSS-->