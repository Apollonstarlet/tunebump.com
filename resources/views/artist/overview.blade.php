 {{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','New Music')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@endsection

{{-- page content --}}
@section('content')
<!-- Artist -->
<div class="section users-edit">
    <div class="mt-3">
<div class="col s12 m6">
    <div class="card horizontal mt-0">
      
      <div class="card-stacked">
        <div class="card-content">
            <span class="custom-header-sm">Submit Music</span>
          <p class="mt-2">Submit your music to playlist curators.</p>
        </div>
        <div class="card-action">
          <a class="btn-large" href="https://tunebump.com/submit-song">New Campaign<i class="material-icons left">music_note</i></a>
        </div>
      </div>
    </div>
  </div>


</div>

    <div class="mt-1 m-3">
<div class="col s12 m6">
    
    <div class="card horizontal mt-0">
      
      <div class="card-stacked">
        <div class="card-content">
            <span class="custom-header-sm">Get more credits</span>
          <p class="mt-2">Purchase credits via PayPal or creditcard.</p>
        </div>
        <div class="card-action">
          <a class="btn-large modal-trigger" href="https://tunebump.com/credits">Buy credits<i class="material-icons left">add_shopping_cart</i></a>
        </div>
      </div>
    </div>
  </div>
  
<div class="col s6 m3">
    <div class="card horizontal">
      <div class="card-stacked">
                  <div class="card-content">
          <span class="col s12 center">Active curators</span>
        </div>
        <div class="card-action">
           
            
            <div>
              <p class="custom-page-header mt-0 center mb-2">4</p>
                      
                    
            </div>  
            
        </div>
      </div>
    </div>
  </div>
  
  <div class="col s6 m3">
    <div class="card horizontal">
      <div class="card-stacked">
                  <div class="card-content">
          <span class="col s12 center">Total playlists</span>
        </div>
        <div class="card-action">
           
            
            <div>
              <p class="custom-page-header mt-0 center mb-2">7</p>
                      
                    
            </div>  
            
        </div>
      </div>
    </div>
  </div>

</div>



    <div class="col s12 mt-4">
        <div>
          <span class="col s12 custom-header-sm">New submissions</span>
          </div>
    </div>
  <div class="col s12 row mb-2">
     <div class="col s12">
        <table class="custom_table">
         <tbody>
           @php
            $i = 0;
           @endphp
           @foreach($data['musics'] as $music)
           @php
            $i = $i + 1;
           @endphp
           <tr class="row">
             <td class="col padding-overview s3 m1 mb-4 mt-3">
                 
                 <img src="{{ $music->img}}" width="75" height="75" style="margin-top: 1rem;">
             </td>
             <td class="col padding-overview s9 m11 mb-2 mt-4">
                 <div class="row">
                     <div class="col s12 m8">
                        <h6 class="col s12 music-title">{{ $music->title}}</h6>
                        <span class="col s12 grey-text lighten-3">By {{ $music->artist}}</span> 
                        <span class="col s12 genres">{{ $music->genres}}</span>
                     </div>
                     <div class="col s12 m4 mt-3">
                          <div class="col s12"><a href="{{$music->spotify}}" target="_blank">
                              
                              <p class="mt-0 grey-text">Listen on<img class="link-music" src="{{asset('images/spotify-logo.png')}}" height="24"></p></a>
                          </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col s12">
                     </div>
                 </div>
             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
     <div class="col s12 center">
       {{ $data['musics']->links('vendor.pagination.custom')}}
     </div>
  </div>
  <div class="row" style="height:120px;"></div>
</div>
@foreach($data['musics'] as $music)
<div id="review{{$music->id}}" class="modal">
  <div class="modal-content">
    <h4 class="mb-3">Comments</h4>
    @foreach($data['reviews'] as $review)
    @if($review->musicId == $music->id)
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