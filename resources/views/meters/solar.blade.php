@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Solar Request')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('vendor-styles')
  <link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
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
              <h4>PEA SOLAR ยินดีให้คำปรึกษาและดูแลคุณ</h4>
              <p>สนใจติดตั้ง หรือสอบถามข้อมูลเพิ่มเติม</p>
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

              <form method="POST" action="{{ route('solar.line-notify') }}">
                @csrf
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="name">ชื่อ - นามสกุล</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                         name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="ชื่อ - นามสกุล" required>
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600" for="address">ที่อยู่ (สถานที่ติดตั้ง)</label>
                  <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" autocomplete="address" placeholder="ที่อยู่ (สถานที่ติดตั้ง)">
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600" for="province">จังหวัด</label>
                  <select class="select2 form-control" name="province_id" id="province">
                    <option value="">เลือกจังหวัด</option>
                    @foreach ($provinces as $province)
                      <option value="{{ $province->id }}">{{ $province->name_th }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600" for="amphure">อำเภอ</label>
                  <select class="select2 form-control" name="amphure_id" id="amphure">
                    <option value="">เลือกอำเภอ</option>
                  </select>
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600" for="district">ตำบล</label>
                  <select class="select2 form-control" name="district_id" id="district">
                    <option value="">เลือกตำบล</option>
                  </select>
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600" for="postcode">รหัสไปรษณีย์</label>
                  <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" autocomplete="postcode" placeholder="รหัสไปรษณีย์" required>
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600" for="telephone">เบอร์ติดต่อกลับ</label>
                  <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="telephone" placeholder="เบอร์ติดต่อกลับ" required>
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600" for="email">อีเมล</label>
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="อีเมล">
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600">ความต้องการ</label>
                  <fieldset>
                    <div class="checkbox">
                      <input type="checkbox" class="checkbox-input" id="install_solar_rooftop" name="install_solar_rooftop" value="1">
                      <label for="install_solar_rooftop">สนใจติดตั้ง/Install Solar Rooftop</label>
                    </div>
                  </fieldset>
                  <fieldset>
                    <div class="checkbox">
                      <input type="checkbox" class="checkbox-input" id="clean_solar_panels" name="clean_solar_panels" value="1">
                      <label for="clean_solar_panels">สนใจล้างแผง/Clean The Solar panels</label>
                    </div>
                  </fieldset>
                </div>

                <div class="form-group mb-50">
                  <label class="text-bold-600">ช่วงเวลาที่สะดวกให้ติดต่อกลับ</label>
                  <fieldset>
                    <div class="checkbox">
                      <input type="checkbox" class="checkbox-input" id="available_morning" name="available_morning" value="1">
                      <label for="available_morning">ช่วงเช้า (9:00 - 12:00 น.)</label>
                    </div>
                  </fieldset>
                  <fieldset>
                    <div class="checkbox">
                      <input type="checkbox" class="checkbox-input" id="available_midday" name="available_midday" value="1">
                      <label for="available_midday">ช่วงกลางวัน (13:00 - 16:00 น.)</label>
                    </div>
                  </fieldset>
                  <fieldset>
                    <div class="checkbox">
                      <input type="checkbox" class="checkbox-input" id="available_evening" name="available_evening" value="1">
                      <label for="available_evening">ช่วงเย็น (16:00 - 19:00 น.)</label>
                    </div>
                  </fieldset>
                </div>

                <fieldset class="form-group">
                  <label class="text-bold-600" for="description">รายละเอียดเพิ่มเติม</label>
                  <textarea class="form-control" name="description" id="description" rows="3" placeholder="รายละเอียดเพิ่มเติม"></textarea>
                </fieldset>

                <p class="text-danger mt-2"><small>เว็บไซต์นี้เป็นเว็บไซต์พาร์ทเนอร์ของ <a href="https://peasolar.pea.co.th/">PEA SOLAR</a> เพื่อสนับสนุนงานบริการ และติดตั้งในส่วนของ<u>ภาคเหนือตอนบน</u>เท่านั้น</small></p>

                <div class="form-group mt-2">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input error" id="validationCheck" name="validationCheck" required>
                    <label class="custom-control-label" for="validationCheck">ยินยอมให้ PEA Solar, ตัวแทน รวมถึงพาร์ทเนอร์ของเราติดต่อคุณได้</label>
                    <p><small>ข้อมูลส่วนบุคคลทั้งหมดที่ให้ไว้กับ PEA SOLAR ในแบบฟอร์มนี้จะนำไปใช้เพื่อติดต่อท่านเพื่อแจ้งข้อมูลเพิ่มเติมเกี่ยวกับบริการติดตั้งระบบผลิตไฟฟ้าจากพลังงานแสงอาทิตย์ ประมวลผลตามคำขอของท่าน และบริการอื่นๆ ที่เหมาะสมสำหรับท่าน หากท่านต้องการศึกษาข้อมูลเพิ่มเติมเกี่ยวกับการคุ้มครองข้อมูลส่วนบุคคลของ PEA SOLAR หรือประสงค์ที่จะใช้สิทธิใดๆ ของเจ้าของข้อมูลส่วนบุคคล ท่านสามารถศึกษารายละเอียดเพิ่มเติมได้ที่ <a href="https://peasolar.pea.co.th/privacy-notice/">ประกาศความเป็นส่วนตัว (Privacy Notice)</a></small></p>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary glow position-relative w-100 mt-2">ส่งข้อมูล<i
                  id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
              </form>
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

@section('vendor-scripts')
  <script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", (event) => {
      window.solarInit();
    });
  </script>
@endpush