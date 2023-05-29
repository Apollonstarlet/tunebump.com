{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Balance')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit" id="balance">
  <div class="row">
     @if(session('success'))
     <div class="col s12">
      <div class="card-alert card green lighten-5">
        <div class="card-content green-text">
          <p>{{ session('success')}}</p>
        </div>
        <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
     </div>
     @endif
     <div class="col s12">
         <span class="col s12 custom-page-header">Balance</span>
     </div>
     <div class="col s12 m4">
       <div class="card">
         <div class="card-content">
            <span class="card-title">Balance</span>
           <p>{{ $data['credits']}} credits</p>
           <input type="hidden" id="current_credit" value="{{ $data['credits']}}">
         </div>
       </div>
     </div>
     
     <div class="col s12 m4">
       <div class="card">
         <div class="card-content">
           <span class="card-title">Withdrawals</span>
           <p>$ {{ $data['paid']}}</p>
         </div>
       </div>
     </div>
     
     <div class="input-field col s12 m4">
      <a href="#modal" id="payout" class="btn-large col s12 modal-trigger">
          Request Payout
      </a>
     </div>
   </div>
 @if($data['count'] == 0)
  <div class="col s12 card-content card gray-text">
    <p>You have not requested any withdrawals.</p>
  </div>
 @else
  <div class="card">
    <div class="card-content">
      <div class="row">
       <div class="col s12">
          <table class="striped">
            <thead>
              <tr>
                <th data-field="price">USD</th>
                <th data-field="credits">Credits</th>
                <th data-field="status">Status</th>
                <th data-field="date">Date</th>
              </tr>
              @foreach ($data['transactions'] as $transaction)
              <tr>
                <td>${{$transaction->amount}}</td>
                <td>{{$transaction->description}}</td>
                <td>
                    @if($transaction->status == 'Pending')
                    <span class="badge oragne lighten-5 orange-text text-accent-4">{{$transaction->status}}</span>
                    @elseif($transaction->status == 'Paid')
                    <span class="badge green lighten-5 green-text text-accent-4">{{$transaction->status}}</span>
                    @else
                    <span class="badge pink lighten-5 pink-text text-accent-2">{{$transaction->status}}</span>
                    @endif
                </td>
                <td>{{$transaction->created_at}}</td>
              </tr>
              @endforeach
              <tr>{{ $data['transactions']->links('vendor.pagination.custom')}}</tr>
            </thead>
            <tbody
            </tbody>
          </table>
       </div>
      </div>
    </div>
  </div>
 @endif
</div>
<div class="row" style="height:50px;"></div>

<div id="modal" class="modal">
  <div class="modal-content">
    <span class="custom-header-sm">Request Payout</span>
    <form role="form" action="{{ route('send-invoice') }}" method="post" data-cc-on-file="false" class="require-validation">
        @csrf
      <div class="row mt-3">
        <div class="col s12 m6">
          <label for="credits" class='control-label'>Amount (minimum 100 credits)</label> 
          <input id="credits" class='form-control' name='credits' type='text' @if(intval($data['credits']) < 100) disabled @endif>
        </div>
        <div class="col s12 m6">
          <label for="account" class='control-label'>PayPal email address</label> 
          <input id="account" class='form-control' name='account' type='email' @if(intval($data['credits']) < 100) disabled @endif>
        </div>
      </div>
      <div class="mt-3">
      <span>Balance: {{ $data['credits']}} credits</span>
      </div>
      <div class="row">
        <div class="input-field col s12 m6">
          <br>
        </div>
        <div class="input-field col s12 m6">
          <button id="request" class="btn-large waves-effect waves-light green right" type="submit" @if(intval($data['credits']) < 100) disabled @endif>Request Withdrawal</button>
        </div>
      </div>
    </form>
  </div>
</div>

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
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
<script>
    var credit = $('#current_credit').val();
    $("input#credits").change(function(){
        var limit = 100, reviews = parseInt($("input#credits").val()), credit = parseInt($("input#current_credit").val());
        if( limit > reviews){
            $("input#credits").val(limit);
        } 
        if(reviews > credit && credit >= 100){
            $("input#credits").val(credit);
        }
    });
   
    $("button#request").click(function(){
        $('div#modal').css('display', 'none');
        $('div#balance').css('display', 'none');
        $('div#preloading').css('display', '');
    })
</script>
@endsection