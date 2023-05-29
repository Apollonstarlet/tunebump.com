<body
  class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns"
  data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

  <!-- BEGIN: Header-->
  <header class="page-topbar" id="header">
    @include('panels.navbar')
  </header>
  <!-- END: Header-->

  <!-- BEGIN: SideNav-->
  @include('panels.sidebar')
  <!-- END: SideNav-->

  <!-- BEGIN: Page Main-->
  <div id="main">
    <div class="row">
      <div class="content-wrapper-before">
      </div>
      <div class="col s12">
        <div class="container">
          {{-- main page content --}}
          @yield('content')
        </div>
        {{-- overlay --}}
        <div class="content-overlay"></div>
      </div>
    </div>
  </div>
  <!-- END: Page Main-->

  {{-- footer  --}}
  @include('panels.footer')
  {{-- vendor and page scripts --}}
  @include('panels.scripts')
</body>