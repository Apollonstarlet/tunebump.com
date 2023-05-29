{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Promotion History')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
    <div class="col s12 mb-2">
        <div>
    <div class="row">
    <div class="col s12">
        <div class="card-stacked card">
      <div class="card-content mb-0">
        <span class="custom-page-header">Promotions</span>
      </div>
      <div class="card-action">
          <span>Check out your promotions and read feedback from curators. You can cancel an active promotion after 7 days and will receive a refund for remaining reviews.</span>
      </div>
      
      </div>
    </div>
  </div>
    
    
  </div>
        
    <div class="card-content">
    </div>
     @if($data['count'] == 0)
     <div class="card-alert">
      <div class="col s12">
        <p>You haven't started any promotions yet.</p>
      </div>
     </div>
     </div>
     @else
     <table class="custom_table mt-2">
       <tbody>
         @foreach($data['ads'] as $music)
         <tr class="col s12 row">
           <td class="col s4 m2 mb-3 mt-2"><img src="{{ $music->img}}" width="75" height="75" style="margin-top: 1rem;"></td>
           <td class="col s8 m10 mt-4 mb-4">
               <div class="row">
                   <div class="col s9 m3">
                      <h6><b>{{ $music->title}}</b></h6>
                      <span>By {{ $music->artist}}</span> 
                   </div>
                   <div class="col s3 m3 mt-2">
                        <span class="gray-text ml-3 vertical-align-top"><b>{{ $music->review}}&nbsp;/&nbsp;{{ $music->term}}</b></span>
                   </div>
                   <div class="col s12 m3 mt-2 mb-3">
                      @if($music->status == "Active")
                      @php $created = substr($music->created_at,0,10);
                           $limit_day = date('Y-m-d', strtotime("+1 week", strtotime($created))); 
                           $current_day = date('Y-m-d');@endphp
                      @if($limit_day < $current_day)
                      <p class="lighten-5 mb-2 mt-0 green-text"><b>{{ $music->status}}</b>&nbsp;&nbsp;&nbsp;&nbsp;<a id="{{ $music->id}}" class="cancel tooltip">Cancel</a></p>
                      @else
                      <p class="lighten-5 mb-2 mt-0 green-text"><b>{{ $music->status}}</b>&nbsp;&nbsp;&nbsp;&nbsp;<a class="grey-text tooltip" disabled>Cancel</a></p>
                      @endif
                      @elseif($music->status == "Completed")
                      <p class="lighten-5 mb-2 mt-0 green-text"><b>{{ $music->status}}</b></p>
                      @else
                      <p class="lighten-5 mb-2 mt-0 red-text"><b>{{ $music->status}}</b></p>
                      @endif
                   </div>
                   <div class="col s12 m3 mt-2">
                      <a href="#review" class="btn mb-2 modal-trigger review" id="{{ $music->id}}">Reviews</a>
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
  <div class="row">
     <div class="col s12 center">
       {{ $data['ads']->links('vendor.pagination.custom')}}
     </div>
  </div>
  <div class="row" style="height:50px;"></div>
</div>

<div id="review" class="modal">
  <div class="modal-content" id="reviews">
    <h5 class="mb-3">Reviews</h5>
  </div>
</div>

<div class="swal-overlay swal-overlay--show-modal" id="confirm_modal" style="display:none;">
  <div class="swal-modal"><div class="swal-icon swal-icon--warning">
    <span class="swal-icon--warning__body"><span class="swal-icon--warning__dot"></span></span>
  </div>
  <div class="swal-title" style="">Are you sure?</div>
  <div class="swal-text" style=""></div>
  <div class="swal-footer">
      <div class="swal-button-container">
        <button id="no" class="swal-button swal-button--cancel" tabindex="0">No, Please!</button>
      </div>
      <div class="swal-button-container">
        <button id="yes" class="swal-button swal-button--delete">Yes, I'm sure</button>
        <div class="swal-button__loader">
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
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script>
    var id, currenturl = window.location.href,
	   url_array = currenturl.split('/'),
	   url = url_array[0] + '//' + url_array[2];
    $('a.review').click(function(e){
        var id = $(this).attr('id');
        var as = '<h5 class="mb-3 mt-0">Reviews</h5><div class="progress"><div class="indeterminate"></div></div>';
		$('div#reviews').html(as);
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	    $.ajax({ url:url+"/reviews", data:{ musicId: id}, type:'post',
		   success: function(result){
		       as = '<h5 class="mb-6 mt-0">Reviews</h5>';
		       if(result.length > 0){
    				result.forEach(function(item) {
    					as += '<div class="row"><div class="col s2 m1 mt-1 mb-2"><img src="'+ item['img'] +'" width="40" height="40" style="border-radius: 50%;"></div><div class="col s8 m8 mt-2 mb-1"><span>'+ item['firstname'] +' (<a href="https://open.spotify.com/user/'+ item['spotifyId'] +'" target="_blank">view Spotify</a>)<br></span></div>';
    				    as += '<div class="col s2 m2 mt-1 mb-2"><a class=""><img height="30" src="images/checked.svg"></a></div><div class="col s12 m10 mb-4 mt-0">'+ item['review'] +'</div></div><div class="divider mb-3"></div>';
    				    
    				});
		       } else{
		           as += '<div class="card-alert card green lighten-5"><div class="card-content"><p>You have not received reviews yet.</p></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
		       }
			   $('div#reviews').html(as);
		   },
		   error: function(result){
			   alert("Failed. Please try again!");
		   }
		});
    })
    
    $('a.cancel').click(function(e){
        id = $(this).attr('id');
        console.log(id);
        $('div#confirm_modal').css("display", "");
    })
    
    $('button#yes').click(function(e){
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	    $.ajax({ url:url+"/cancel", data:{ musicId: id}, type:'post',
		   success: function(result){
		       window.location.reload(true);
		   },
		   error: function(result){
			   alert("Failed. Please try again!");
		   }
		});
    })
    
    $('button#no').click(function(e){
        $('div#confirm_modal').css("display", "none"); 
    })
</script>
@endsection