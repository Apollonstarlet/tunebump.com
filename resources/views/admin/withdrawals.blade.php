{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Withdrawals')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
  <div class="row">
     @if(count($data['transactions']) == 0)
     <div class="card-alert card green lighten-5">
      <div class="card-content green-text">
        <p>There is any withdrawals yet.</p>
      </div>
      <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
     </div>
     @else
      <div class="card">
        <div class="card-content">
          <h5>Withdrawals</h5>
          <div class="row">
           <div class="col s12">
              <table class="striped">
                <thead>
                  <tr>
                    <th data-field="paypal">Paypal</th>
                    <th data-field="paypal">Name</th>
                    <th data-field="price">Amount</th>
                    <th data-field="credits">Description</th>
                    <th data-field="status">Status</th>
                    <th data-field="date">Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data['transactions'] as $transaction)
                  <tr>
                    <td>{{$transaction->paypal}}</td>
                    <td>{{$transaction->firstname}}({{$transaction->email}})</td>
                    <td>${{$transaction->amount}}</td>
                    <td>{{$transaction->description}}</td>
                    <td>
                        @if($transaction->status == 'Pending')
                        <span class="badge oragne lighten-5 orange-text text-accent-4">{{$transaction->status}}&nbsp;&nbsp;&nbsp;&nbsp;<a id="{{ $transaction->id}}" class="payment">Pay</a></span>
                        @elseif($transaction->status == 'Paid')
                        <span class="badge green lighten-5 green-text text-accent-4">{{$transaction->status}}</span>
                        @else
                        <span class="badge pink lighten-5 pink-text text-accent-2">{{$transaction->status}}</span>
                        @endif
                    </td>
                    <td>{{$transaction->created_at}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
           </div>
          </div>
        </div>
      </div>
     @endif
  </div>
  <div class="row" style="height:50px;"></div>
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
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script>
    var id, currenturl = window.location.href,
	   url_array = currenturl.split('/'),
	   url = url_array[0] + '//' + url_array[2];
    $('a.payment').click(function(e){
        id = $(this).attr('id');
        $('div#confirm_modal').css("display", "");
        
    })
    
    $('button#yes').click(function(e){
        console.log(id);
        console.log(url);
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
	    $.ajax({ url:url+"/admin-pay", data:{ id: id}, type:'post',
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