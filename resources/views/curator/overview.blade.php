{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Awaiting Reviews')

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
<!-- Curator -->
<div class="section users-edit">
    <span class="col s12 custom-page-header">Submissions</span>
  <div class="row">
     <div>
        <div class="card-content">
             @if(count($data['review_music']) == 0)
             <div class="card-alert  lighten-5">
              <div class="card-content gray-text">
                <a href="https://tunebump.com/playlists"><input class="btn-large mb-2" type="button" value="Add your playlists"></a>
               <div class="card-content card">
                <span>You currently have 0 new song submissions.</span>
               </div> 
              </div>
             </div>
             @else
              <table class="custom_table">
               <tbody>
                 @php
                  $i = 0;
                 @endphp
                 @foreach($data['review_music'] as $music)
                  @php
                    $i = $i + 1;
                  @endphp
                  <div class="review-container-1">
                  <tr class="row col s12">
                   <td class="col s3 m2 mb-3 mt-4 padding-overview">
                       <img src="{{ $music->img}}" width="75" height="75"  style="margin-top:1rem; margin-bottom:0.75rem;">
                   </td>
                   <td class="col s9 m10 mb-2 mt-4">
                       <div class="row col s12">
                           <div class="col s12 m8">
                              <h6>{{ $music->title}}</h6>
                              <span class="grey-text lighten-3">By {{ $music->artist}}</span> 
                              <p class="mt-1">{{ $music->genres}}</p>
                           </div>
                           <div class="col s7 m4 mt-1">
                                <div class="col s12">
                                <div class="col s12 mb-2">
                                <a class="black-text" href="{{$music->spotify}}" target="_blank">Listen on<img class="link-music" src="{{asset('images/spotify-logo.png')}}" height="24"></a>
                                </div>
                                
                           </div>
                           <div class="col s12">
                                <div class="col s12 mt-2">
                                    <a href="#{{$music->id}}" class="btn modal-trigger mb-5">Review</a>
                                </div>
                                </div>
                       </div>
                   </td>
                   </div>
                   </div>
                  </tr>
                 @endforeach
               </tbody>
             </table>
             @endif  
        </div>
     </div>
  </div>
  <div class="row" style="height:120px;"></div>
</div>
@foreach($data['musics'] as $music)
<div id="{{$music->id}}" class="modal">
  <div class="modal-content">
    <form role="form" action="{{ route('review') }}" method="post">
        @csrf
    <div class="review-container-1">
 
            <div class="mt-0">      
      <div class="card-stacked">
        <div class="card-content">
                      <div class="col s8 m3">
                      <img src="{{ $music->img}}" width="100" height="100"  style="margin-top:1rem; border-radius:0px;">
                    </div>
          <div class="col s12 m7 mt-5">
          <span class="custom-page-header">{{$music->title}}</span>
          <p class="mt-0 custom-header-xs">By {{$music->artist}}</p>
          </div>
          
        </div>
        <div class="card-action">
        <div class="col s12 m3">
          <a class=" col s12 btn mb-5" id="ccc{{$music->id}}" class="btn" onclick="playFunction('{{$music->title}}--{{ $music->img}}--{{ $music->link}}--{{ $music->artist}}--{{$music->id}}')"><i class="material-icons left">play_circle_outline</i>Play</a>
        </div>
          <a class="col  gray-text" href="{{$music->spotify}}" target="_blank">Listen on<img class="link-music" src="images/spotify-logo.png" height="24"></a>
        </div>
              </div>
           </div>
           
           
           
      </div>
     </div> 
      <div class="row mt-0">
        <div class="input-field col s12 mb-0">
            
        <div class="card horizontal mb-0">      
      <div class="card-stacked">
        <div class="card-content">
        <div class="input-field col s12">
          <input name="status" id="status" type="hidden" value="0">
          <input name="musicId" type="hidden" id="musicId" value="{{$music->id}}">
          <textarea id="icon_prefix2" minlength="50" maxlength="500" class="materialize-textarea" name="review"></textarea>
          <label for="icon_prefix2">Write your feedback here</label>
            <div class="input-field col s12 m8">
                <label><input type="checkbox" id="check"><span>I have added this track to one or more playlists (optional)</span></label>
            </div>
            <div class="input-field col s12">
          <button id="submit" class="btn right" type="submit">Submit</button>
            </div>
        </div>
        </div>
        </div>
        </div>
        
        
      </div>
    </form>
  </div>
</div>
@endforeach
<!-- users edit ends -->

@endsection
{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('js/music.js')}}"></script>
<script>
(function($) {
    var checkbox = false,
       currenturl = window.location.href,
	   url_array = currenturl.split('/'),
	   url = url_array[0] + '//' + url_array[2];
	   
    $('input#check').click(function(e){
        checkbox = !checkbox;
        if(checkbox == true){
            $('input#status').val('1');
        } else{
            $('input#status').val('0');
        }
    });
    
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
})(window.jQuery);
</script>
@endsection