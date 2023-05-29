<aside
  class="sidenav-main nav-expanded nav-lock nav-collapsible  sidenav-active-square  sidenav-light">
  <div class="brand-sidebar">
    <h1 class="logo-wrapper">
      <a class="brand-logo darken-1" @if(isset($user))href="{{asset('home')}}" @else href="{{asset('dashbord')}}" @endif">
        <img class="hide-on-med-and-down" src="{{asset('images/tunebump-logo6.png')}}" alt="materialize logo">
        <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset('images/logo/materialize-logo.png')}}" alt="materialize logo">
      </a>
  </div>
  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
    data-menu="menu-navigation" data-collapsible="menu-accordion">
    @if(isset($user))
        @if($user->role == 'admin')
        <li class="bold">
          <a class="collapsible-header waves-effect waves-cyan " href="javascript:void(0)">
            <i class="material-icons">group</i>
            <span class="menu-title">{{ __('locale.Users')}}</span>
          </a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li class="{{(request()->is('home')) ? 'active' : '' }}">
                <a href="{{asset('home')}}"
                  class="{{(request()->is('home')) ? 'active' : '' }}"
                  style="{{(request()->is('home')) ? 'margin-right: 0px;' : '' }}">
                  <i class="material-icons">radio_button_unchecked</i>
                  <span>{{ __('locale.Artists')}}</span>
                </a>
              </li>
              <li class="{{(request()->is('curators')) ? 'active' : '' }}">
                <a href="{{asset('curators')}}"
                  class="{{(request()->is('curators')) ? 'active' : '' }}"
                  style="{{(request()->is('curators')) ? 'margin-right: 0px;' : '' }}">
                  <i class="material-icons">radio_button_unchecked</i>
                  <span>{{ __('locale.Curators')}}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="bold {{(request()->is('verifyPlaylist')) ? 'active' : '' }}">
          <a class="{{ (request()->is('verifyPlaylist')) ? 'active' : ''}}"
            href="{{asset('verifyPlaylist')}}" style=" {{ (request()->is('verifyPlaylist')) ? 'margin-right: 0px;' : ''}}">
            <i class="material-icons">library_books</i>
            <span class="menu-title">{{ __('locale.Playlist')}}</span>
          </a>
        </li>
        <li class="bold {{(request()->is('withdraw')) ? 'active' : '' }}">
          <a class="{{ (request()->is('withdraw')) ? 'active' : ''}}"
            href="{{asset('withdraw')}}" style=" {{ (request()->is('withdraw')) ? 'margin-right: 0px;' : ''}}">
            <i class="material-icons">monetization_on</i>
            <span class="menu-title">{{ __('locale.Withdrawals')}}</span>
          </a>
        </li>
        <li class="bold {{(request()->is('setting')) ? 'active' : '' }}">
          <a class="{{ (request()->is('setting')) ? 'active' : ''}}"
            href="{{asset('setting')}}" style=" {{ (request()->is('setting')) ? 'margin-right: 0px;' : ''}}">
            <i class="material-icons">settings</i>
            <span class="menu-title">{{ __('locale.Settings')}}</span>
          </a>
        </li>
        @else
            <ul>
              <li class="{{(request()->is('home')) ? 'active' : '' }}">
                <a href="{{asset('home')}}" class="{{(request()->is('home')) ? 'active' : '' }}"
                  style="{{(request()->is('home')) ? 'margin-right: 0px;' : '' }}">
                  <i class="material-icons">home</i>
                  <span>{{ __('locale.Overview')}}</span>
                </a>
              </li>
              <!--
              <li class="{{(request()->is('home-hot')) ? 'active' : '' }}">
                <a href="{{asset('home-hot')}}" class="{{(request()->is('home-hot')) ? 'active' : '' }}"
                  style="{{(request()->is('home-hot')) ? 'margin-right: 0px;' : '' }}">
                  <i class="material-icons">fiber_manual_record</i>
                  <span>{{ __('locale.Hot')}}</span>
                </a>
              </li> -->
            </ul>
        <li class="bold {{(request()->is('promotions')) ? 'active' : '' }}">
          <a class="{{ (request()->is('promotions')) ? 'active' : ''}}"
            href="{{asset('promotions')}}" style=" {{ (request()->is('promotions')) ? 'margin-right: 0px;' : ''}}">
            <i class="material-icons">library_books</i>
            <span class="menu-title">{{ __('locale.Promotions')}}</span>
          </a>
        </li>
        <li class="bold {{(request()->is('credits')) ? 'active' : '' }}">
          <a class="{{ (request()->is('credits')) ? 'active' : ''}}"
            href="{{asset('credits')}}" style=" {{ (request()->is('credits')) ? 'margin-right: 0px;' : ''}}">
            <i class="material-icons">monetization_on</i>
            <span class="menu-title">{{ __('locale.Balance')}}</span>
          </a>
        </li>
        <li class="bold {{(request()->is('submit-song')) ? 'active' : '' }}">
          <a class="{{ (request()->is('submit-song')) ? 'active' : ''}}"
            href="{{asset('submit-song')}}" style=" {{ (request()->is('submit-song')) ? 'margin-right: 0px;' : ''}}">
            <i class="material-icons">add_to_photos</i>
            <span class="menu-title">{{ __('locale.New_song')}}</span>
          </a>
        </li>
        @endif
    @else
    <li class="bold">
      </a>
          <li class="{{(request()->is('dashboard')) ? 'active' : '' }}">
            <a href="{{asset('dashboard')}}"
              class="{{(request()->is('dashboard')) ? 'active' : '' }}"
              style="{{(request()->is('dashboard')) ? 'margin-right: 0px;' : '' }}">
              <i class="material-icons">home</i>
              <span>{{ __('locale.ToReview')}}</span>
            </a>
          </li>
    </li>
    <li class="bold {{(request()->is('playlist')) ? 'active' : '' }}">
      <a class="{{ (request()->is('playlist')) ? 'active' : ''}}"
        href="{{asset('playlists')}}" style=" {{ (request()->is('playlists')) ? 'margin-right: 0px;' : ''}}">
        <i class="material-icons">library_books</i>
        <span class="menu-title">{{ __('locale.Playlist')}}</span>
      </a>
    </li>
    <li class="bold {{(request()->is('balance')) ? 'active' : '' }}">
      <a class="{{ (request()->is('balance')) ? 'active' : ''}}"
        href="{{asset('balance')}}" style=" {{ (request()->is('balance')) ? 'margin-right: 0px;' : ''}}">
        <i class="material-icons">monetization_on</i>
        <span class="menu-title">{{ __('locale.Credits')}}</span>
      </a>
    </li>
    @endif
  </ul>
  <div class="navigation-background"></div>
  <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
    href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>