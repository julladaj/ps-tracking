@extends('layouts.fullLayoutMaster')
{{-- title --}}

@section('title','Login')

{{-- page scripts --}}

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- login page start -->
<section id="auth-login" class="row flexbox-container">
  <div class="col-xl-8 col-11">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-login -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">{{ __('auth.welcome_back') }}</h4>
              </div>
            </div>
            <div class="card-body">
              @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="bx bx-info-circle mr-1 align-middle"></i> {{ $errors->first() }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              <form method="POST" action="{{ route('post-login') }}">
                @csrf
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="email">{{ __('auth.email') }}</label>
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{ __('auth.email') }}">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="text-bold-600" for="password">{{ __('auth.password') }}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="{{ __('auth.password') }}">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                  <div class="text-left">
                    <div class="checkbox checkbox-sm">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember">
                        <small>{{ __('auth.remember_me') }}</small>
                      </label>
                    </div>
                  </div>
{{--                  <div class="text-right">--}}
{{--                    <a href="{{ route('auth-forgot-password') }}" class="card-link"><small>{{ __('auth.forget_password') }}</small></a>--}}
{{--                  </div>--}}
                </div>
                <button type="submit" class="btn btn-primary glow w-100 position-relative">{{ __('locale.Login') }}
                  <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                </button>
              </form>
{{--              <hr>--}}
{{--              <div class="text-center">--}}
{{--                <small class="mr-25">{{ __('auth.dont_have_account') }}</small>--}}
{{--                <a href="{{ route('auth-register') }}"><small>{{ __('auth.sign_up') }}</small></a>--}}
{{--              </div>--}}
            </div>
          </div>
        </div>
        <!-- right section image -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
          <img class="img-fluid" src="{{asset('images/pages/login.png')}}" alt="branding logo">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- login page ends -->
@endsection
