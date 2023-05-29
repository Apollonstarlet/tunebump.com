<div class="navbar navbar-fixed ">
  <nav
    class="navbar-main navbar-color nav-collapsible no-shadow nav-expanded sideNav-lock  navbar-dark gradient-45deg-indigo-purple">
    <div class="nav-wrapper">
      <ul class="navbar-list right">
        <li>
          <span id="name">
              @if(isset($user))
                @if($user->role == 'admin')
                    Admin
                @else
                    {{ $user->firstname}} {{ $user->lastname}} (artist)
                @endif
              @else
                {{ $data['user']->firstname}} (curator)
              @endif
          </span>
        </li>
        <li>
          <a class="profile-button" href="javascript:void(0);" data-target="profile-dropdown" style="padding: 5px 15px;">
            <img @if(isset($user)) src="{{ asset($user->img) }}" @else src="{{ $data['user']->img}}" @endif alt="" width="28" height="28" style="border-radius: 50%;" id="avatar">
          </a>
        </li>
      </ul>
      <!-- profile-dropdown-->
      <ul class="dropdown-content" id="profile-dropdown" style="box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);">
        @if(isset($user))
        <li>
          <a class="grey-text text-darken-1" href="{{ route('setting') }}">
            <i class="material-icons">person_outline</i>
            Profile
          </a>
        </li>
        <li class="divider"></li>
        @endif
        <li>
          <a class="grey-text text-darken-1" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
            <i class="material-icons">keyboard_tab</i>
            {{ __('locale.Logout')}}
          </a>
      <form id="frm-logout" action="{{ route('logout') }}" method="POST">
      @csrf
      </form>
        </li> 
      </ul>
    </div>
  </nav>
</div>