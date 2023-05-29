{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Playlists')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section users-edit">
  <div class="card">
    <div class="card-content">
     <h5>Playlists</h5>
     @if(count($data['playlists']) == 0)
     <div class="card-alert card green lighten-5">
      <div class="card-content green-text">
        <p>You have not posted any music yet.</p>
      </div>
      <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
     </div>
     @else
     <table class="custom_table mt-2">
       <tbody>
         @foreach($data['playlists'] as $val)
         <tr class="row">
           <td class="col s4 m1 mb-2"><img src="{{ $val->img}}" width="75" height="75" style="margin-top: 1rem;"></td>
           <td class="col s8 m11 mt-1 mb-2">
               <div class="row">
                   <div class="col s12 m3">
                      <h6><b>{{ $val->title}}</b></h6>
                      <span>By {{ $val->firstname}}</span> 
                   </div>
                   <div class="col s12 m3">
                      <h6>{{ $val->genres}}</h6> 
                   </div>
                   <div class="col s12 m3">
                     <select id="status" name="status">
                      <option @if($val->status == 'review') selected @endif disabled>On review</option>
                      <option class="green" value="{{ $val->spotifyId}}?Accepted" @if($val->status == 'Accepted') selected @endif>Verify</option>
                      <option class="red" value="{{ $val->spotifyId}}?Denied" @if($val->status == 'Denied') selected @endif>Reject</option>
                     </select>
                   </div>
                   <div class="col s12 m3 center">
                      <a href="https://open.spotify.com/playlist/{{ $val->spotifyId}}" class="btn green" target="_blank"><i class="material-icons">remove_red_eye</i></a>
                   </div>
               </div>
           </td>
         </tr>
         @endforeach
       </tbody>
     </table>
     @endif
   </div>
  </div>
  <div class="row" style="height:50px;"></div>
</div>

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
<script src="{{asset('js/scripts/form-select2.js')}}"></script>
<script>
$( "select#status" ).change(function() {
    var value = $(this).val(),
        data = value.split('?'),
        currenturl = window.location.href,
	    url_array = currenturl.split('/'),
	    url = url_array[0] + '//' + url_array[2];
        
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	   $.ajax({ url:url+"/status", data:{ id: data[0], status: data[1]}, type:'post',
		   success: function(result){
			   console.log(result)
		   },
		   error: function(result){
			   console.log("failed");
		   }
		});
});
</script>
@endsection