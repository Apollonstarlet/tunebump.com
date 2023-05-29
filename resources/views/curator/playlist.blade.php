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
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section users-edit">
  <span class="col s12 custom-page-header">Playlists</span>
  <div class="row">
     <div class="col s12">
         @if(session('success'))
            <div class="card-alert card green">
              <div class="card-content white-text">
                <p>{{ session('success')}}</p>
              </div>
              <button type="button" class="close gray-text" data-dismiss="alert" aria-label="Close">
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
         <ul class="tabs mt-1 card">
            <li class="tab">
              <a class="display-flex align-items-center active" id="all-tab" href="#all">
                <span>All {{ count($data['playlists'])}}</span>
              </a>
            </li>
            <li class="tab">
              <a class="display-flex align-items-center" id="review-tab" href="#review">
                <span>On review {{ count($data['review_playlists'])}}</span>
              </a>
            </li>
            <li class="tab">
              <a class="display-flex align-items-center" id="accepted-tab" href="#accepted">
                <span>Accepted {{ count($data['accept_playlists'])}}</span>
              </a>
            </li>
            <li class="tab">
              <a class="display-flex align-items-center" id="denied-tab" href="#denied">
                <span>Denied {{ count($data['denied_playlists'])}}</span>
              </a>
            </li> 
         </ul>
         <br>
         <div class="mb-2">
         <a class="waves-effect waves-light btn-large mb-2 mr-1 modal-trigger" id="add_p"><i class="material-icons left">add</i> Add playlist</a>
         </div>
         <div class="card" id="add_playlist" style="display: none;">
            <div class="card-content">
                <form action="{{ route('addPlaylist') }}" method="post">
                @csrf
                <input name='id' type='text' value='{{ $data['user']->spotifyId}}' style='display: none;'>
                <div class="row">
                    <label for="credits" class='col s12 control-label'>Paste your Spotify playlist url here</label> 
                    <div class="input-field col s12">
                      <input class='form-control' placeholder="https://open.spotify.com/playlist/example" name='url' type='text' id="url">
                    </div>
                    <div class="col s12 m4 input-field">
                      <select name="main_genre" id="main-genre" class="select2 browser-default">
                        <option value="0" disabled selected>Select genres</option>
                        @foreach($data['genres'] as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col s12 m8 input-field">
                      <div id="sub-select" style="display:;">
                        <select class="max-length browser-default" multiple="multiple" name="sub_genre[]" id="sub-genre">
                        </select>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                      <button class="btn waves-effect waves-light right" onclick="document.getElementById('addPlaylist').submit();">Confirm</button>
                    </div>
                </div>
                </form>
            </div>
          </div>
         <div id="all">
             @if(count($data['playlists']) == 0)
              <div class="card-content gray-text">
                <p>You currently have 0 playlists connected to your account.</p>
              </div>
             @else
             <table class="striped">
               <tbody>
                 @foreach($data['playlists'] as $val)
                 <tr class="row custom_tr">
                   <td class="col s4 mt-2 mb-2"><img style="border-radius: 0px;" src="{{ $val->img}}" width="75" height="75"></td>
                   <td class="col s8 mt-2 mb-2">
                       <div class="row">
                           <div class="col s12 m6">
                               <a href="https://open.spotify.com/playlist/{{ $val->spotifyId}}" target="_blank"><h6 class="blue-text">{{ $val->title}}</h6></a>
                               <span>{{ $val->genres}}</span>
                           </div>
                           <div class="col s12 m6">
                               Tracks: {{ $val->tracks}}<br>followers: {{ $val->followers}} <br>Status: @if($val->status == 'review')<span class="badge write lighten-5 yellow-text text-accent-4">On {{ $val->status}}</span>
                            @elseif($val->status == 'Accepted')<span class="badge write lighten-5 green-text text-accent-4">{{ $val->status}}</span>
                            @else <span class="badge write lighten-5 red-text text-accent-4">{{ $val->status}}</span>
                            @endif
                           </div>
                       </div>
                   </td>
                 </tr>
                 @endforeach
                 <tr>{{ $data['playlists']->links('vendor.pagination.custom')}}</tr>
               </tbody>
             </table>
             @endif
         </div>
         <div id="review">
             @if(count($data['review_playlists']) == 0)
             <div col="col s12 m5">
              <div class="card-content gray-text">
                <p>You currently have 0 playlists on review.</p>
              </div>
             </div>
             @else
             <table class="striped">
               <tbody>
                 @foreach($data['review_playlists'] as $val)
                 <tr class="row custom_tr">
                   <td class="col s4 mt-2 mb-2"><img src="{{ $val->img}}" width="75" height="75"></td>
                   <td class="col s8 mt-2 mb-2">
                       <div class="row">
                           <div class="col s12 m6">
                               <a href="https://open.spotify.com/playlist/{{ $val->spotifyId}}" target="_blank"><h6 class="blue-text">{{ $val->title}}</h6></a>
                               <span class="gray-text">{{ $val->genres}}</span>
                           </div>
                           <div class="col s12 m6">
                               Tracks: {{ $val->tracks}}<br>followers: {{ $val->followers}} <br>Status: <span class="badge write lighten-5 yellow-text text-accent-4">On {{ $val->status}}</span>
                           </div>
                       </div>
                   </td>
                 </tr>
                 @endforeach
                 <tr>{{ $data['review_playlists']->links('vendor.pagination.custom')}}</tr>
               </tbody>
             </table>
             @endif
         </div>
         <div id="accepted">
             @if(count($data['accept_playlists']) == 0)
              <div class="card-content gray-text">
                <p>You currently have 0 accepted playlists.</p>
              </div>
             @else
             <table class="striped">
               <tbody>
                 @foreach($data['accept_playlists'] as $val)
                 <tr class="row custom_tr">
                   <td class="col s4 mt-2 mb-2"><img src="{{ $val->img}}" width="75" height="75"></td>
                   <td class="col s8 mt-2 mb-2">
                       <div class="row">
                           <div class="col s12 m6">
                               <a href="https://open.spotify.com/playlist/{{ $val->spotifyId}}" target="_blank"><h6 class="blue-text">{{ $val->title}}</h6></a>
                               <span>{{ $val->genres}}</span>
                           </div>
                           <div class="col s12 m6">
                               Tracks: {{ $val->tracks}}<br>followers: {{ $val->followers}} <br>Status: <span class="badge write lighten-5 green-text text-accent-4">{{ $val->status}}</span>
                           </div>
                       </div>
                   </td>
                 </tr>
                 @endforeach
                 <tr>{{ $data['accept_playlists']->links('vendor.pagination.custom')}}</tr>
               </tbody>
             </table>
             @endif
         </div>
         <div id="denied">
             @if(count($data['denied_playlists']) == 0)
              <div class="card-content gray-text">
                <p>You currently have 0 denied playlists.</p>
              </div>
             @else
             <table class="striped">
               <tbody>
                 @foreach($data['denied_playlists'] as $val)
                 <tr class="row custom_tr">
                   <td class="col s4 mt-2 mb-2"><img src="{{ $val->img}}" width="75" height="75"></td>
                   <td class="col s8 mt-2 mb-2">
                       <div class="row">
                           <div class="col s12 m6">
                               <a href="https://open.spotify.com/playlist/{{ $val->spotifyId}}" target="_blank"><h6 class="blue-text">{{ $val->title}}</h6></a>
                               <span class="gray-text">{{ $val->genres}}</span>
                           </div>
                           <div class="col s12 m6">
                               Tracks: {{ $val->tracks}}<br>followers: {{ $val->followers}} <br>Status: <span class="badge write lighten-5 red-text text-accent-4">{{ $val->status}}</span>
                           </div>
                       </div>
                   </td>
                 </tr>
                 @endforeach
                 <tr>{{ $data['denied_playlists']->links('vendor.pagination.custom')}}</tr>
               </tbody>
             </table>
             @endif
         </div>
     </div>
  </div>
  <div class="row" style="height:50px;"></div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script>
$(document).ready(function () {
   "use strict";

   var i = true, currenturl = window.location.href,
	   url_array = currenturl.split('/'),
	   url = url_array[0] + '//' + url_array[2];
   $("#add_p").click(function (){
       if( i == true)
       $("div#add_playlist").css("display", "");
       else
       $("div#add_playlist").css("display", "none");
       i = !i;
   });
   
   $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%',
        placeholder: 'Search for Genres',
    });  
	   
   $("#main-genre").change(function() {
        var main = this.value;
        console.log(main);
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
		   },
		   error: function(result){
			   alert("Failed. Please try again!");
		   }
		});
    });
      
   // Limiting the number of selections
   $(".max-length").select2({
      dropdownAutoWidth: true,
      width: '100%',
      maximumSelectionLength: 5,
      placeholder: "Sub genres"
   });
});
</script>
@endsection