 {{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Credits')

{{-- vendor styles --}}
@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section" id="wallet">
  <div class="row">
     <div class="col s12 m4">
       <div class="card lighten-3 gradient-shadow">
         <div class="card-content">
           <p class="mb-2">Credits</p>
           <p>
             <span class="custom-page-header mb-0">{{ $data['credits']}}</h6>
           </p>
         </div>
         <div class="card-action">
           <a href="#modal" class="waves-effect waves-light btn-large modal-trigger">Buy Credits</a>
         </div>
       </div>
     </div>
     @if(session('success'))
     <div class="col s12 m8">
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
     @if(session('error'))
     <div class="col s12 m4 card-alert card red lighten-5">
      <div class="card-content red-text">
        <p>{{ session('error')}}</p>
      </div>
      <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
     </div>
     @endif
     @if(isset($message))
     <div class="card-alert card red lighten-5">
      <div class="card-content red-text">
        <p>{{ $message }}</p>
      </div>
      <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
     </div>
     @endif
   </div>
 @if($data['count'] == 0)
 <div class="col s12 card-alert">
  <div>
      <div class="col s12 divider mb-2"></div>
    <p>You haven't purchased any credits.</p>
  </div>
 </div>
 @else
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Transactions</span>
          <table class="striped">
            <thead>
              <tr>
                <th data-field="id">Date</th>
                <th data-field="name">Credits</th>
                <th data-field="price">Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data['transactions'] as $transaction)
              <tr>
                <td>{{substr($transaction->created_at,0,16)}}</td>
                <td>{{$transaction->description}}</td>
                <td>${{$transaction->amount}}</td>
              </tr>
              @endforeach
              <tr>{{ $data['transactions']->links('vendor.pagination.custom')}}</tr>
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
    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
      @csrf
      <div class="row">
          <div class="col s12" id="select_credit">
              <span class="custom-page-header">Buy Credits</span>
              <div class="row">
                <div class="input-field col s6 m4">
                    <p>
                      <label>
                        <input class="with-gap" name="group" type="radio" id="1" checked/>
                        <span>100 Credits</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input class="with-gap" name="group" type="radio" id="2"/>
                        <span>250 Credits</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input class="with-gap" name="group" type="radio" id="3"/>
                        <span>500 Credits</span>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input class="with-gap" name="group" type="radio" id="4"/>
                        <span>1000 Credits</span>
                      </label>
                    </p>
                    <input type="hidden" id="group" value="1">
                    <input type="hidden" name="credit" id="credit" value="100">
                    <input type="hidden" name="mount" id="mount" value="10">
                </div>
                <div class="input-field col grey-text s6 m4">
                    <p>Quantity</p>
                    <p>
                        <a id="min" class="btn custom_btn"><i class="material-icons">remove</i></a>
                        &nbsp;&nbsp;<span id="quantity">1</span>&nbsp;&nbsp;
                        <a id="max" class="btn custom_btn"><i class="material-icons">add</i></a>
                    </p>
                </div>
                <div class="col s12 m4">
            <div class="row" style="padding: 0 10px;">
                <div class="input-field col s12">
                  <h6 class="grey-text">
                      <span id="credits">100</span> credits
                  </h6>
                  <div class="divider mt-2"></div><div class="margin-order"><span class="custom-header-xs">Total </span class="custom-header-xs"> $<span class="custom-header-xs" id="usd">10</span></div>
                  
                </div>
            </div>
            <div class="input-field col s12">
                  <a class="btn" id="next"><i class="material-icons right">arrow_forward</i>Next</a>
                </div>
          </div>
              </div>
          </div>
          <div class="col s12" id="credit_pay" style="display: none;">
              <h5 class="mt-0">Payment method</h5>
              <div class="row">
                <div class="input-field col s12">
                  <a id="pay" class="btn waves-effect waves-light col s12">Pay with PayPal</a>
                </div>
              </div>
              <div class="col s12 row center">
                  <h6>Or</h6>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <a id="credit_card" class="btn waves-effect waves-light green col s12">Pay with credit card</a>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <a class="btn grey" id="back"><i class="material-icons left">arrow_back</i>Back</a>
                </div>
              </div>
              
              <div>
                <div class="mt-6 mb-2">
                By completing your transaction, you agree to our <a href="https://tunebump.com/terms">terms of use</a>, <a href="https://tunebump.com/privacy">privacy policy</a> and <a href="https://tunebump.com/refunds">refund policy.</a>
                </div>
                <a href="https://stripe.com/en-nl">    
                <img src="images/Stripe-logo.svg" height="50"></a>
                </a>
             </div> 
          </div>
          <div class="col s12" id="pay_card" style="display: none;" >
              <h5 class="mt-0">Card information</h5>
              <div class="row">
                <div class="input-field col s12">
                    <input id="credit-demo" type="text" class="card-number">
                    <label for="credit-demo">Card number*</label>
                </div>
                <div class="input-field col s3">
                  <input id="cvc-demo" type="text" class="card-cvc">
                  <label for="cvc-demo">CVC*</label>
                </div>
                <div class="input-field col s9">
                  <input class='card-expiry-date' id="date-demo" type="text">
                  <label for="date-demo">Expiration Date(MM/YYYY)*</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <button id="pay" class="btn waves-effect waves-light green col s12" type="submit">Pay now</button>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <a class="btn grey" id="back1"><i class="material-icons left">arrow_back</i>Back</a>
                </div>
              </div>
          </div>
      </div>
      
    </form>
    <form action="{{ route('paypal.post')}}" method="post" id="pay_paypal">
        @csrf
		<input type="hidden" name="amount" id="amount" value="10">
    </form>
  </div>
</div>

<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Error</h4>
      <p id="error"></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close btn green">Ok</a>
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
<script src="{{asset('vendors/formatter/jquery.formatter.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
<script src="https://js.stripe.com/v2/"></script>
<script>
$(function() {
    var $form = $(".require-validation"), count, val, credit, mount;
    
    $('#credit-demo').formatter({
        'pattern': '@{{9999999999999999}}',
        'persistent': true
      });
    $('#cvc-demo').formatter({
        'pattern': '@{{999}}',
        'persistent': true
      });
    $('#date-demo').formatter({
        'pattern': '@{{99}}/@{{9999}}',
      });
    
    $('a#pay').click(function(){
        $('form#pay_paypal').submit();
    })
    $('a#credit_card').click(function(){
        $('#credit_pay').css('display', 'none');
        $('#pay_card').css('display', '');
    })
    $("button#pay").click(function(){
        $('div#modal').modal('close');
        $('div#wallet').css('display', 'none');
        $('div#preloading').css('display', '');
    })
    
    function change(mount, credit, key){
        $("span#credits").html(mount);
        $("span#usd").html(credit);
        $("input#credit").val(mount);
        $("input#mount").val(credit);
        $("input#amount").val(credit);
        $("span#quantity").html(1);
        $("input#group").val(key);
    }
    $("a#next").click(function(){
        $('#credit_pay').css('display', '');
        $('#select_credit').css('display', 'none');
    })
    $("a#back").click(function(){
        $('#credit_pay').css('display', 'none');
        $('#select_credit').css('display', '');
    })
    $("a#back1").click(function(){
        $('#pay_card').css('display', 'none');
        $('#credit_pay').css('display', '');
    })
    $("input#1").click(function(){
        change(100, 10, 1);
    })
    $("input#2").click(function(){
        change(250, 25, 2);
    })
    $("input#3").click(function(){
        change(500, 50, 3);
    })
    $("input#4").click(function(){
        change(1000, 100, 4);
    })
    
    function myfunction(mount, credit, val){
        $("span#credits").html(mount*val);
        $("span#usd").html(credit*val);
        $("input#credit").val(mount*val);
        $("input#mount").val(credit*val);
        $("input#amount").val(credit*val);
    }
    $("a#min").click(function (){
        count = Number($("span#quantity").html());
        if(count != 1){
            val = count - 1;
            var key= $("input#group").val();
            if(key == 1){
                myfunction(100, 10, val);
            } else if(key == 2){
                myfunction(250, 25, val);
            } else if(key == 3){
                myfunction(500, 50, val);
            } else{
                myfunction(1000, 100, val);
            }
            $("span#quantity").html(val);
            $("input#quantity").val(val);
        }
    });
    $("a#max").click(function (){
        count = Number($("span#quantity").html());
        if(count < 3){
            val = count + 1;
            var key= $("input#group").val();
            if(key == 1){
                myfunction(100, 10, val);
            } else if(key == 2){
                myfunction(250, 25, val);
            } else if(key == 3){
                myfunction(500, 50, val);
            } else{
                myfunction(1000, 100, val);
            }
            $("span#quantity").html(val);
            $("input#quantity").val(val);
        }
    });
   
    $('form.require-validation').bind('submit', function(e) {
        var inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true,
        exp_date = $('.card-expiry-date').val().split("/"),
        exp_year = exp_date[1],
        exp_month = exp_date[0];
        
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
              number: $('.card-number').val(),
              cvc: $('.card-cvc').val(),
              exp_month: exp_month,
              exp_year: exp_year
          }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {
        if(response.error) {
            $('div#preloading').css('display', 'none');
            $('div#wallet').css('display', '');
            $('div#modal1').modal('open');
            $('input#cvc-demo').val('');
            $('input#credit-demo').val('');
            $('input#date-demo').val('');
            $('p#error').html(response.error.message +'. Please try again!');
            
        }else {
          /* token contains id, last4, and card type */
          var token = response['id'];
          $form.find('input[type=text]').empty();
          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
          $form.get(0).submit();
        }
    }
});
</script>
@endsection