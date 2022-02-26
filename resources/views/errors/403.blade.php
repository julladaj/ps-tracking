@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Not-authorized')

@section('content')
<!-- not authorized start -->
<section class="row flexbox-container">
  <div class="col-xl-7 col-md-8 col-12">
    <div class="card bg-transparent shadow-none">
      <div class="card-body text-center">
        <img src="{{asset('images/pages/not-authorized.png')}}" class="img-fluid" alt="not authorized" width="400">
        <h1 class="my-2 error-title">{{ __('role.not_authorized') }}</h1>
        <p>{{ __('role.not_authorized_detail') }}</p>
        <a href="{{ \App\Providers\RouteServiceProvider::HOME }}" class="btn btn-primary round glow mt-2">{{ __('role.back_to_home') }}</a>
      </div>
    </div>
  </div>
</section>
<!-- not authorized end -->
@endsection
