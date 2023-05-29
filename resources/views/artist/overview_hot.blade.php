{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Hot Music')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@endsection

{{-- page content --}}
@section('content')
<!-- Artist -->
<div class="section users-edit">
    <div class="col s12 mt-2 mb-2">
        <div>
            <div class="col s12 mt-2 mb-2"><img height="30" src="images/Spotify_Logo_RGB_Black.png"></div>
          <h5 class="mb-0 mt-0">Trending music</h5>
          <p class="mt-0">Most popular submissions in the last 24 hours.</p>
          <div class="col s12 divider mb-2"></div>
        </div> 
        <div>
                      <a href="https://tunebump.com/submit-song" class="waves-effect mt-2 waves-light btn-1 modal-trigger"><i class="material-icons">add_to_photos</i> Promote a song</a>
                      </div>
    </div>                  
          <div class="row mt-2 mb-2">
     <div class="col s12">
        <table class="custom_table">
         <tbody>
           @php
            $j = 0;
           @endphp
           @foreach($data['hot'] as $music)
           @php
            $j = $j + 1;
           @endphp
           <tr class="row">
             <td class="col s3 padding-overview m1 mb-4 mt-3"><a id="cc{{$music->id}}" class="custom_play" onclick="playFunction('{{$music->title}}--{{ $music->img}}--{{ $music->link}}--{{ $music->artist}}--{{$music->id}}')"></a><img src="{{ $music->img}}" width="75" height="75" style="margin-top: 1rem;"></td>
             <td class="col s9 padding-overview m11 mb-2 mt-4">
                 <div class="row">
                     <div class="col s7 m8">
                        <h6>{{ $music->title}}</h6>
                        <span class="grey-text lighten-3">By {{ $music->artist}}</span> 
                     </div>
                     <div class="col s5 m4 mt-1">
                          <a href="{{$music->spotify}}" target="_blank"><img src="{{asset('images/spotify.png')}}" width="24" height="24"></a>
                          <a id="like">
                              @php $flag_key = 0; @endphp
                              @foreach($data['like'] as $like)
                                  @if($like->musicId == $music->id)
                                      @php $flag_key = 1; continue; @endphp
                                  @endif
                              @endforeach
                              @if($flag_key == 0)
                              <span class="material-icons ml-3" id="favorite">favorite_border</span>
                              @else
                              <span class="material-icons ml-3" id="favorite">favorite</span>
                              @endif
                              <span class="ml-3 vertical-align-top" id="like">{{ $music->like}}</span>
                              <input type="hidden" id="like" value="{{ $flag_key}}">
                              <input type="hidden" id="musicId" value="{{ $music->id}}">
                              <input type="hidden" id="userId" value="{{ $user->id}}">
                          </a>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col s12">
                        <span class="genres">{{ $music->genres}}</span>
                     </div>
                 </div>
             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
     <div class="col s12 center">
        {{ $data['hot']->links('vendor.pagination.custom')}}
     </div>
  </div>
  <div class="row" style="height:120px;"></div>
</div>
@foreach($data['hot'] as $music)
<div id="review{{$music->id}}" class="modal">
  <div class="modal-content">
    <h4 class="mb-3">Reviews</h4>
    @php $i = 0; @endphp
    @foreach($data['reviews'] as $review)
    @if($review->musicId == $music->id)
    @php $i += 1; @endphp
    <div class="row">
        <div class="col s4 m2 mt-2">
          <img src="{{ $review->img}}" width="75" height="75" style="border-radius: 50%;">
        </div>
        <div class="col s8 m10 mt-2">
          <span>{{ $review->firstname}} (<a href="https://open.spotify.com/user/{{ $review->spotifyId}}" target="_blank">Curator</a>)<br>
          {{ $review->review}}</span>
        </div>
    </div>
    <div class="divider mb-3"></div>
    @endif
    @endforeach
    @if($i == 0)
     <div class="card-alert card green lighten-5">
      <div class="card-content green-text">
        <p>You have not posted any music yet.</p>
      </div>
      <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
     </div>
    @endif
  </div>
</div>
<div style="display: none;"><a id="ccc{{$music->id}}" class="custom_play"></a></div>
@endforeach
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('js/music.js')}}"></script>
<script>
$(document).ready(function () {
   "use strict";

   var currenturl = window.location.href,
	   url_array = currenturl.split('/'),
	   url = url_array[0] + '//' + url_array[2];
	
   $("a#like").click(function (e){
      var flag = $(this).children('input#like').val(),
          musicId = $(this).children('input#musicId').val(),
          userId = $(this).children('input#userId').val();
      
      if(flag == 0){
	   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	   $.ajax({ url:url+"/add_like", data:{ musicId: musicId, userId: userId}, type:'post',
		   success: function(result){
		   },
		   error: function(result){
			   alert("Failed. Please try again!");
		   }
		});
        var like = Number($(this).children('span#like').html());
        like = like + 1;
        $(this).children('span#like').html(like);
        $(this).children('span#favorite').html('favorite');
        $(this).children('input#like').val(1);
      } else{
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	    $.ajax({ url:url+"/remove_like", data:{ musicId: musicId, userId: userId}, type:'post',
		   success: function(result){
		   },
		   error: function(result){
			   alert("Failed. Please try again!");
		   }
		});
        var like = Number($(this).children('span#like').html());
        like = like - 1;
        $(this).children('span#like').html(like);
        $(this).children('span#favorite').html('favorite_border');
        $(this).children('input#like').val(0);  
      }
   });
});
</script>
@endsection