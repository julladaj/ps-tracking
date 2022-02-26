@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Forgot Password')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- forgot password start -->
<section class="row flexbox-container">
  <div class="col-xl-7 col-md-9 col-10  px-0">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-forgot password -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">{{ __('auth.forget_password') }}</h4>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group d-flex justify-content-lg-between justify-content-center flex-wrap align-items-center mb-2">
                <div class="text-left">
                  <div class="mb-1">
                    <a href="{{ route('auth-login') }}"  class="card-link btn btn-outline-primary text-nowrap">{{ __('auth.sign_in') }}</a>
                  </div>
                </div>
                  <div class="mb-1">
                  <a href="{{ route('auth-register') }}" class="card-link btn btn-outline-primary text-nowrap">{{ __('auth.sign_up') }}</a>
                </div>
              </div>
              <div class="text-muted text-center mb-2">
                <small>{{ __('auth.forget_password_detail') }}</small>
              </div>
              {{-- form --}}
              <form class="mb-2" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group mb-2">
                  <label class="text-bold-600" for="email">{{ __('auth.username_or_email') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{ __('auth.username_or_email') }}">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary glow position-relative w-100">{{ __('auth.send_password') }}
                  <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                </button>
              </form>

              <div class="text-center mb-2">
                <a href="{{ route('auth-login') }}">
                  <small class="text-muted">{{ __('auth.sign_in') }}</small>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- right section image -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center">
          <img class="img-fluid" src="{{asset('images/pages/forgot-password.png')}}" alt="branding logo" width="300">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- forgot password ends -->
@endsection
