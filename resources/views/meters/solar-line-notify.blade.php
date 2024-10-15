@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Solar Request')
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
            <div class="text-center">
              <h4>ส่งข้อมูลสำเร็จ</h4>
              <p>ขอบคุณที่ไว้วางใจการไฟฟ้าส่วนภูมิภาค หากไม่มีเจ้าหน้าที่ติดต่อไป หรือเกิดความล่าช้า กรุณาติดต่อเจ้าหน้าที่โดยตรงที่สำนักงานตามที่อยู่ ที่ลูกค้าเลือกติดตั้ง</p>
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
