@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Register')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- register section starts -->
<section class="row flexbox-container">
  <div class="col-xl-8 col-10">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- register section left -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">{{ __('auth.sign_up') }}</h4>
              </div>
            </div>
            <div class="text-center">
              <p> <small> {{ __('auth.sign_up_detail') }}</small>
              </p>
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

              <form method="POST" action="{{ route('post-register') }}">
                @csrf
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="name">{{ __('auth.full_name') }}</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="{{ __('auth.full_name') }}">
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                  <div class="form-group mb-50">
                  <label class="text-bold-600" for="email">{{ __('auth.email') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="{{ __('auth.email') }}">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600" for="password">{{ __('auth.password') }}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="{{ __('auth.password') }}">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group mb-2">
                  <label class="text-bold-600" for="password-confirm">{{ __('auth.confirm_password') }}</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('auth.confirm_password') }}">
                </div>
                <button type="submit" class="btn btn-primary glow position-relative w-100">{{ __('auth.sign_up') }}<i
                  id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
              </form>
              <hr>
              <div class="text-center"><small class="mr-25">{{ __('auth.already_have_account') }}</small>
                <a href="{{ asset('login') }}"><small>{{ __('auth.sign_in') }}</small> </a>
              </div>
            </div>
          </div>
        </div>
        <!-- image section right -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
            <img class="img-fluid" src="{{asset('images/pages/register.png')}}" alt="branding logo">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- register section endss -->
@endsection
