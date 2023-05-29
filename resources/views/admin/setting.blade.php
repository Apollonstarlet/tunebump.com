{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Settings')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
  <h5>Settings</h5>
  <div class="row">
     <div class="col s12">
        <div class="card-content">
          <ul class="tabs mt-1 mb-2">
            <li class="tab">
              <a class="align-items-center active" id="profile-tab" href="#profile">
                <i class="material-icons">person</i><span>Profile</span>
              </a>
            </li>
            <li class="tab">
              <a class="display-flex align-items-center" id="password-tab" href="#password">
                <i class="material-icons">lock</i><span>Password</span>
              </a>
            </li>
          </ul>
          <div class="divider mb-3"></div>
          @if(session('success'))
            <div class="card-alert card green lighten-5">
              <div class="card-content green-text">
                <p>{{ session('success')}}</p>
              </div>
              <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          @elseif(session('error'))
            <div class="card-alert card red lighten-5">
              <div class="card-content red-text">
                <p>{{ session('error')}}</p>
              </div>
              <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          @endif
          <div id="profile">
             <form action="{{ route('profile') }}" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="row">
                <div class="col s12">
                  <div class="media display-flex align-items-center mb-2">
                    <a class="mr-2" href="#">
                      <img src="{{asset($user->img)}}" id="profile-avatar" class="circle"
                        height="75" width="75">
                    </a>
                    <div class="media-body">
                      <div class="user-edit-btns display-flex">
                        <a id="select-avatar" class="btn-small green">Change</a>
                      </div>
                    </div>
                  </div>
                  <input id="upfile" accept="image/*" type="file" name="image" onchange="loadFile(event)" style="display:  none;"/>
                </div>
                <div class="col s12 input-field">
                    <input id="firstname" name="firstname" type="text" class="validate" value="{{$user->firstname}}">
                    <label for="firstname">firstname</label>
                </div>
                <div class="col s12 input-field">
                    <input id="lastname" name="lastname" type="text" class="validate" value="{{$user->lastname}}">
                    <label for="lastname">lastname</label>
                </div>
                <div class="col s12 input-field">
                  <input id="email" name="email" type="email" class="validate" value="{{$user->email}}" disabled>
                  <label for="email">E-mail</label>
                </div>
                <div class="col s12 display-flex justify-content-end mt-3">
                  <button type="submit" class="btn green">
                    Save changes</button>
                </div>
              </div>
             </form>
          </div>
          <div id="password">
             <form id="PasswordForm" action="{{ route('set-pwd') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col s12 input-field">
                    <input id="oldpwd" name="oldpwd" type="password">
                    <label for="oldpwd">Current Password</label>
                </div>
                <div class="col s12 input-field">
                    <input id="newpwd" name="newpwd" type="password">
                    <label for="newpwd">New Password</label>
                </div>
                <div class="col s12 input-field">
                    <input id="repwd" name="repwd" type="password">
                    <label for="repwd">Confirm Password</label>
                </div>
                <div class="col s12 display-flex justify-content-end mt-3">
                  <button type="submit" class="btn green">
                    Save changes</button>
                </div>
              </div>
             </form>
          </div>   
        </div>
     </div>
  </div>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
<script>
  var loadFile = function(event) {
    var image = document.getElementById('profile-avatar');
    image.src = URL.createObjectURL(event.target.files[0]);
  };

  $(document).ready(function () {
    // upload button converting into file button
    $("a#select-avatar").on("click", function () {
      $("#upfile").click();
    })
  });
</script>
@endsection