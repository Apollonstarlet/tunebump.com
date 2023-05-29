{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Overview')

{{-- vendor styles --}}
@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="row" >
    <div id="view-simple-circular">
     <div id="preload" class="col s12 center" style="margin-top:300px;">
        <div class="preloader-wrapper big active">
          <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div>
            <div class="gap-patch">
              <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
      <div id="alert" class="col s12 center" style="margin-top:300px; display:none;">
          <div class="card-alert card orange lighten-5">
            <div class="card-content orange-text">
                <p><i class="material-icons">warning</i> Unfortunately, the loading times are long.<br>Please log out and log in again.</p>
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
<script src="{{asset('js/preload.min.js')}}"></script>
@endsection