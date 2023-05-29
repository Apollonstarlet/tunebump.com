{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','New Promotion')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/dropify/css/dropify.min.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section" id="new_promotion">
    <div class="mt-2">
    <div class="card mb-0 blue white-text horizontal">
      <div class="card-stacked">
        <div class="card-content">
          <p class="custom-page-header white-text mt-0 mb-0">New campaign</p>
        </div>
      </div>
    </div>
  </div>
    
  <div class="card mt-0">
    <div class="card-content card-content-promotion">
      <!-- <div class="card-body"> -->
      <div class="col s12">
      </div>
      <div class="row">
          @if(session('success'))
            <div class="card-alert green card">
              <div class="card-content white-text">
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
          @endif
        </div>
        <div>
          <!-- users edit Info form start -->
          <form id="addSong" action="{{ route('add.song') }}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="row">
              <div class="col s12">
                <div class="row">
                  <div class="col s12 mt-1 input-field">
                      
                    <div>
                        <img src="images/spotify-logo.png" height="27">
                    <input id="link" type="text" placeholder="Type track url from Spotify here" required>
                    </div>
                  </div>
                  <div id="view-indeterminate-linear" style="display: none;">
                    <div class="row mt-3">
                      <div class="col s12">
                        <div class="progress">
                          <div class="indeterminate"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col s12 mt-0 input-field" id="media" style="display: none;">
                    <div class="row" style="background-color: #; padding-top: 7px;">
                        <div class="col s3 m2">
                            <img height="75" width="75" id="song_image" style="border-radius: 0;">
                        </div>
                        <div class="col s8">
                            <h5 id="title" class="custom-header-sm mb-0"></h5>
                            <h6 id="artist" class="mt-1"></h6>
                        </div>
                    </div>
                  </div>
                  <div class="col s12 mt-1 display-flex justify-content-begin"><label for="text" class="active black-text">Upload MP3 version of track</label></div>
                  <div class="col s12 m4 input-field mobile-padding">
                      
                      <input type="file" accept="audio/*" id="input-file-disable-remove" name="upfile" class="dropify" data-disable-remove="true" required/>
                  </div>
                  <div class="col s12 mt-1 display-flex justify-content-begin"><label for="text" class="active black-text">Choose genres</label></div>
                  <div class="col s12 m6 input-field">
                    <select name="main_genre" id="main-genre" class="select2 browser-default">
                        <option value="0" disabled selected>Main genre</option>
                        @foreach($data['genres'] as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col s12 m6 input-field">
                    <div id="sub-select" style="display: ;">
                        <select class="max-length browser-default" multiple="multiple" name="sub_genre[]" id="sub-genre">
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row mt-2">
                    <div class="col s12 mt-1 mb-0 display-flex justify-content-begin"><label for="text" class="active blue-text">Available curators <span id="num_curator"> 0</span></label></div>
                  <div class="col s12 mt-0 input-field">
               <div class="card-alert">
                    </div>
                  </div>
                  <div class="col s12 m6 input-field mt-0">
                    <input id="term" placeholder="Type curator reach" type="number" name="term">
                  </div>
                  <div class="col s12 display-flex justify-content-end m6">
                  <div>
                    <input type="hidden" id="balance" value="{{$data['credit']->credits}}" disabled>
                    
                    <div class="card-alert">
                <a id="pay_submit" class="btn-large green" disabled><span id="cost">0</span>&nbsp;&nbsp;credits&nbsp;&nbsp;  | &nbsp;&nbsp;  Pay and Submit</a>
                      <p id="more" style="display: none;"><i class="material-icons">info_outline</i> Insufficient balance, <a href="{{ asset('balance')}}">get more credits.</a></p>
                    </div>
                  </div>
                  
                  </div>
                  
                </div>
              </div>
              
            </div>
            <div class="row" id="required_info" style="display: none;">
             <div class="card-alert card red lighten-5">
              <div class="card-content red-text">
                <p>Please insert required infomation!</p>
              </div>
             </div>
            </div>
          </form>
          <!-- users edit Info form ends -->
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <div class="row" style="height:50px;"></div>
</div>
<!-- users edit ends -->
<div class="row" id="preloading" style="display: none;">
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
    </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
<script src="{{asset('js/scripts/form-file-uploads.js')}}"></script>
<script>
$(document).ready(function () {
   "use strict";

   var main, currenturl = window.location.href,
	   url_array = currenturl.split('/'),
	   url = url_array[0] + '//' + url_array[2],
	   balance = $('input#balance').val(),
	   flag0 = false,
	   flag1 = false,
	   flag2 = false,
	   flag3 = false;
    
   $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%',
        placeholder: 'Search for Genres',
    });  
   $("#sub-genre").change(function() {
       $('div#required_info').css('display', 'none');
       var sub_genres = $(this).val();
       console.log(sub_genres);
       $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	    $.ajax({ url:url+"/getsub_num", data:{ mainId: main, subGenres: sub_genres}, type:'post',
		   success: function(result){
			   $('span#num_curator').html(result);
			   flag2 = true;
		   },
		   error: function(result){
		   }
		});
    });
    
   $("#main-genre").change(function() {
       $('div#required_info').css('display', 'none');
       $('span#num_curator').html('0');
        main = this.value;
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	    $.ajax({ url:url+"/getsub", data:{ mainId: main}, type:'post',
		   success: function(result){
	            let txt = '';
                result['genres'].forEach(myFunction);
                function myFunction(value) {
                  txt += '<option value="'+ value.subname +'">'+ value.subname +'</option>';
                }
                $("select#sub-genre").html(txt);
                $("div#sub-select").css("display", "");
                flag1 = true;
		   },
		   error: function(result){
			   alert("Failed. Please try again!");
	           $("div#media").css("display", "");
	           $("div#view-indeterminate-linear").css("display", "none");
		   }
		});
    });
      
   // Limiting the number of selections
   $(".max-length").select2({
      dropdownAutoWidth: true,
      width: '100%',
      maximumSelectionLength: 5,
      placeholder: "Sub genres (max. 5)"
   });
    
   $("input#link").on('paste', function (e){
       $('div#required_info').css('display', 'none');
	   var song_url = e.originalEvent.clipboardData.getData('text'),
	       song = song_url.split('?');
	   $("input#id").val(song[0]);
	   $("div#view-indeterminate-linear").css("display", "");    
	   $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	   $.ajax({ url:url+"/link", data:{ url: song[0]}, type:'post',
		   success: function(result){
			   var title = result['name'],
			       artist = result['album']['artists'][0]['name'],
			       song_image = result['album']['images'][0]['url'];
			   $("img#song_image").attr("src", song_image);
			   $("h5#title").html(title);
			   $("h6#artist").html(artist);
	           $("div#media").css("display", "");
	           $("div#view-indeterminate-linear").css("display", "none");
	           flag0 = true;
		   },
		   error: function(result){
			   alert("Failed. Please try again!");
	           $("div#media").css("display", "");
	           $("div#view-indeterminate-linear").css("display", "none");
		   }
		});
   });
   
   $("input#term").change(function(){
        $('div#required_info').css('display', 'none');
        var limit, limit_str, reviews;
        limit_str = $('span#num_curator').html();
        limit = parseInt(limit_str);
        reviews = parseInt(this.value);
        if( limit < reviews){
            $("input#term").val(limit);
            reviews = limit;
        }
        var valueSelected = 20*reviews;
        $('span#cost').html(valueSelected);
        if(balance < valueSelected){
            $('p#more').css('display', '');
        } else{
            $('p#more').css('display', 'none');
            $('a#pay_submit').removeAttr('disabled');
            flag3 = true;
        }
   });
   
   $("a#pay_submit").click(function(){
        if(flag0 == true && flag1 == true && flag2 == true && flag3 == true){
            console.log("ok");
            $('div#new_promotion').css('display', 'none');
            $('div#preloading').css('display', '');
            $('form#addSong').submit();
        } else{
            console.log("bad");
            $('div#required_info').css('display', '');
        }
   });
});
</script>
@endsection