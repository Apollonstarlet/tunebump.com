@extends('layouts.fullLayoutMaster')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-content">
        <div class="card-title">{{ __('Verify Your Email Address') }}</div>
          @if (session('resent'))
          <div class="card-alert card green lighten-5" role="alert">
              <div class="card-content green-text">
                {{ __('A fresh verification link has been sent to your email address.') }}
              </div>
          </div>
          @endif

          {{ __('Before proceeding, please check your email for a verification link.') }}
          {{ __('If you did not receive the email') }},
          <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit"
                  class="waves-effect waves-light btn">{{ __('click here to request another') }}</button>.
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
