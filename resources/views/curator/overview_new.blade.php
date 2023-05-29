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
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@endsection

{{-- page content --}}
@section('content')
<!-- Curator -->
<div class="section users-edit">
  <p class="col s12 page-titles">Latest promotions</p>
  <div class="row">
     <div class="col s12">
        <div class="card-content mt-2">
          @if(count($data['musics']) == 0)
             <div class="card-alert card green lighten-5">
              <div class="card-content green-text">
                <p>Listen to the newest song releases on Tunebump</p>
              </div>
             </div>
             @else
             <table class="custom_table">
               <tbody>
                 @php
                  $i = 0;
                 @endphp
                 @foreach($data['musics'] as $music)
                  @php
                    $i = $i + 1;
                    $flag = false;
                    foreach($data['playlist'] as $playlist){
                        if($playlist->genre == $music->genre){
                            $genres = explode(", ", $playlist->genres);
                            foreach($genres as $genre){
                                $fla = strpos($music->genres, $genre);
                                if($fla == true){
                                    $flag = true;
                                    continue;
                                }
                            }
                        }
                        if($flag == true){
                            continue;
                        }
                    }
                    if($flag == true){
                        if($music->review < $music->term){
                            foreach($data['review_list'] as $val){
                                if($val->musicId == $music->id){
                                    $flag = false;
                                    continue;
                                }
                            }
                        } else{
                            $flag = false;
                        }
                    }
                  @endphp
                 <tr class="row">
                   <td class="col s3 m1 mb-4 mt-3 padding-overview"><div class="custom_num">{{$i}}</div><a id="cc{{$music->id}}" class="custom_play" onclick="playFunction('{{$music->title}}--{{ $music->img}}--{{ $music->link}}--{{ $music->artist}}--{{$music->id}}')"></a><img src="{{ $music->img}}" width="75" height="75"  style="margin-top: 1rem; border-radius:5px;"></td>
                   <td class="col s9 m11 mb-2 mt-4 padding-overview">
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
                                    <input type="hidden" id="userId" value="{{ $data['user']->id}}">
                                </a> 
                           </div>
                       </div>
                       <div class="row">
                           <div class="col s12 m6">
                              <span>{{ $music->genres}}</span>
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
  </div>
  <div class="row">
     <div class="col s12 center">
       {{ $data['musics']->links('vendor.pagination.custom')}}
     </div>
  </div>
  <div class="row" style="height:120px;"></div>
</div>
<!-- users edit ends -->
@foreach($data['musics'] as $music)
<div style="display: none;"><a id="ccc{{$music->id}}" class="custom_play"></a></div>
@endforeach
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
            $('button#submit').prop('disabled', false);
        } else{
            $('button#submit').prop('disabled', true);
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