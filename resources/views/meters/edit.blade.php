@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','แก้ไขข้อมูล')

@section('page-styles')
    <style>
        .vertical-middle {
            margin: auto 0;
        }
    </style>
@endsection

@section('content')
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">เพิ่ม/แก้ไขข้อมูล งานขยายเขตระบบจำหน่ายไฟฟ้า</h5>
                        <div class="heading-elements">
                            <button type="button" submit="form_meter" class="btn btn-primary submit-button"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible mb-2 mt-2" role="alert">
                                <div class="d-flex align-items-center"><i class="bx bx-like"></i><span>{!! session()->get('success') !!}</span></div>
                            </div>
                        @endif

                        <form class="form form-horizontal" id="form_meter" method="POST" action="{{ ($isCreate)? route('meters.store') : route('meters.update', $meter) }}">
                            @csrf
                            @if(!$isCreate)
                                @method('PUT')
                            @endif
                            <div class="form-body">
                                <div class="alert bg-rgba-primary mt-1 p-1">
                                    <h4 class="text-primary">แผนกบริการลูกค้า</h4>
                                    <p class="m-0">เพิ่ม/แก้ไขข้อมูล<code class="highlighter-rouge">งานขยายเขต</code>ระบบจำหน่ายไฟฟ้า</p>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>เลขที่คำร้อง</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="meters[document_number]" placeholder="เลขที่คำร้อง" value="{{ $meter->document_number?? old('meters.document_number') }}">
                                    </div>

                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>วันที่ยื่นคำร้อง</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="meters[document_date]" placeholder="วันที่ยื่นคำร้อง" value="{{ $meter->document_date?? old('meters.document_date') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ชื่อ-นามสกุล</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="meters[customer_name]" placeholder="ชื่อ-นามสกุล" value="{{ $meter->customer_name?? old('meters.customer_name') }}">
                                    </div>

                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>เบอร์โทรศัพท์</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="meters[customer_phone]" placeholder="เบอร์โทรศัพท์" value="{{ $meter->customer_phone?? old('meters.customer_phone') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ประเภทงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="meters[job_type_id]">
                                            @forelse($job_types as $job_type)
                                                <option value="{{ $job_type->id }}" {{ ((isset($meter->job_type_id) && $meter->job_type_id === $job_type->id) || old('meters.job_type_id') === $job_type->id)? 'selected':'' }}>{{ $job_type->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>หม้อแปลง ขนาด</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="meters[transformer_id]">
                                            @forelse($transformers as $transformer)
                                                <option value="{{ $transformer->id }}" {{ ((isset($meter->transformer_id) && $meter->transformer_id === $transformer->id) || old('meters.transformer_id') === $transformer->id)? 'selected':'' }}>{{ $transformer->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>หมายเลขงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="meters[job_number]" placeholder="หมายเลขงาน" value="{{ $meter->job_number?? old('meters.job_number') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ชื่อผู้สำรวจ</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="meters[survey_user_id]">
                                            @forelse($pea_staffs as $pea_staff)
                                                <option value="{{ $pea_staff->id }}" {{ ((isset($meter->survey_user_id) && $meter->survey_user_id === $pea_staff->id) || old('meters.survey_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ปริมาณงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="meters[job_amount_id]">
                                            @forelse($job_amounts as $job_amount)
                                                <option value="{{ $job_amount->id }}" {{ ((isset($meter->job_amount_id) && $meter->job_amount_id === $job_amount->id) || old('meters.job_amount_id') === $job_amount->id)? 'selected':'' }}>{{ $job_amount->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>สถานะงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="meters[job_status_id]">
                                            @forelse($job_statuses as $job_status)
                                                <option value="{{ $job_status->id }}" {{ ((isset($meter->job_status_id) && $meter->job_status_id === $job_status->id) || old('meters.survey_user_id') === $job_status->id)? 'selected':'' }}>{{ $job_status->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>อนุมัติที่</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="meters[approve_location]" placeholder="อนุมัติที่" value="{{ $meter->approve_location?? old('meters.approve_location') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ลงวันที่</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="meters[approve_date]" placeholder="ลงวันที่" value="{{ $meter->approve_date?? old('meters.approve_date') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>หมดกำหนดยื่นราคา</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="meters[expires_quote_date]" placeholder="หมดกำหนดยื่นราคา" value="{{ $meter->expires_quote_date?? old('meters.expires_quote_date') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>วันที่ชำระเงิน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="meters[payment_date]" placeholder="วันที่ชำระเงิน" value="{{ $meter->payment_date?? old('meters.payment_date') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ผบค. ส่งงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="meters[service_final_date]" placeholder="ผบค. ส่งงาน" value="{{ $meter->service_final_date?? old('meters.service_final_date') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle"></div>
                                    <div class="col-md-4 vertical-middle">
                                        <fieldset>
                                            <div class="checkbox">
                                                <input type="checkbox" class="checkbox-input" id="no_payment" name="meters[no_payment]" value="1" {{ ((isset($meter->no_payment) && $meter->no_payment) || old('meters.no_payment'))? 'checked':'' }}>
                                                <label for="no_payment">ไม่มีค่าใช้จ่ายเรียกเก็บจากผู้ใช้ไฟ</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>หมายเหตุ</label>
                                    </div>
                                    <div class="col-md-10 form-group vertical-middle">
                                        <textarea class="form-control" rows="3" name="meters[comment]" placeholder="หมายเหตุ">{{ $meter->comment?? old('meters.comment') }}</textarea>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mt-1">
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
                                        <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
                                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </div>

                            @if(!$isCreate)
                            <hr>

                            <div class="form-body">
                                <input type="hidden" name="meters[electric_expand_id]" value="{{ $meter->electric_expand_id?? 0 }}">
                                <div class="alert bg-rgba-primary mt-1 p-1">
                                    <h4 class="text-primary">รายละเอียด</h4>
                                    <p class="m-0">ขออนุมัติ<code class="highlighter-rouge">ขยายเขต/ย้ายแนว</code>ระบบจำหน่ายไฟฟ้า</p>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ชื่องาน</label>
                                    </div>
                                    <div class="col-md-10 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[job_name]" placeholder="ชื่องาน" value="{{ $meter->electric_expand->job_name?? old('electric_expands.job_name') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>สถานที่ใช้ไฟฟ้า</label>
                                    </div>
                                    <div class="col-md-10 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[location]" placeholder="สถานที่ใช้ไฟฟ้า" value="{{ $meter->electric_expand->location?? old('electric_expands.location') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ลักษณะการใช้พลังงานไฟฟ้า</label>
                                    </div>
                                    <div class="col-md-10 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[consumer_type]" placeholder="ลักษณะการใช้พลังงานไฟฟ้า" value="{{ $meter->electric_expand->consumer_type?? old('electric_expands.consumer_type') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>สภาพภูมิประเทศ</label>
                                    </div>
                                    <div class="col-md-10 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[geo]" placeholder="สภาพภูมิประเทศ" value="{{ $meter->electric_expand->geo?? old('electric_expands.geo') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>สภาพพื้นดิน</label>
                                    </div>
                                    <div class="col-md-10 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[env_earth]" placeholder="สภาพพื้นดิน" value="{{ $meter->electric_expand->env_earth?? old('electric_expands.env_earth') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>สภาพต้นไม้ตามแนวขยายเขต</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[env_tree]" placeholder="สภาพต้นไม้ตามแนวขยายเขต" value="{{ $meter->electric_expand->env_tree?? old('electric_expands.env_tree') }}">
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <fieldset>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="electric_expands[env_tree_distant_km]" placeholder="กิโลเมตร" aria-describedby="env_tree_distant_km" value="{{ $meter->electric_expand->env_tree_distant_km?? old('electric_expands.env_tree_distant_km') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="env_tree_distant_km">กม.</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-1 text-right vertical-middle">
                                        <label>ป่าสงวน</label>
                                    </div>
                                    <div class="col-md-3 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[reserved_forest]" placeholder="ป่าสงวน" value="{{ $meter->electric_expand->reserved_forest?? old('electric_expands.reserved_forest') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>นำรถยนต์เข้าปฏิบัติงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[working_with_car]" placeholder="นำรถยนต์เข้าปฏิบัติงาน" value="{{ $meter->electric_expand->working_with_car?? old('electric_expands.working_with_car') }}">
                                    </div>
                                    <div class="col-md-1 text-right vertical-middle">
                                        <label>สภาพชุมชน</label>
                                    </div>
                                    <div class="col-md-5 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[env_community]" placeholder="สภาพชุมชน" value="{{ $meter->electric_expand->env_community?? old('electric_expands.env_community') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>รับพลังงานไฟฟ้าจากหม้อแปลง PEA</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[use_pea_transformer]" placeholder="รับพลังงานไฟฟ้าจากหม้อแปลง PEA" value="{{ $meter->electric_expand->use_pea_transformer?? old('electric_expands.use_pea_transformer') }}">
                                    </div>
                                    <div class="col-md-1 text-right vertical-middle">
                                        <label>ขนาด</label>
                                    </div>
                                    <div class="col-md-1 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[use_pea_transformer_size]" placeholder="ขนาด" value="{{ $meter->electric_expand->use_pea_transformer_size?? old('electric_expands.use_pea_transformer_size') }}">
                                    </div>
                                    <div class="col-md-1 text-right vertical-middle">
                                        <label>ระบบ</label>
                                    </div>
                                    <div class="col-md-3 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[use_pea_transformer_type]" placeholder="ระบบ" value="{{ $meter->electric_expand->use_pea_transformer_type?? old('electric_expands.use_pea_transformer_type') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>โวลท์ จากสถานี</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[volt_from_station]" placeholder="โวลท์ จากสถานี" value="{{ $meter->electric_expand->volt_from_station?? old('electric_expands.volt_from_station') }}">
                                    </div>
                                    <div class="col-md-1 text-right vertical-middle">
                                        <label>ฟีดเดอร์</label>
                                    </div>
                                    <div class="col-md-1 form-group vertical-middle">
                                        <input type="text" class="form-control" name="electric_expands[feeder]" placeholder="ฟีดเดอร์" value="{{ $meter->electric_expand->feeder?? old('electric_expands.feeder') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ระยะห่างจากสถานีตามระบบจำหน่าย</label>
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <fieldset>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="electric_expands[feeder_distant_km]" placeholder="กิโลเมตร" aria-describedby="feeder_distant_km" value="{{ $meter->electric_expand->feeder_distant_km?? old('electric_expands.feeder_distant_km') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="feeder_distant_km">กม.</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mt-1">
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
                                        <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
                                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
{{--                    <div class="card-footer border-top text-right">--}}
{{--                        <button type="button" submit="form_meter" class="btn btn-primary submit-button"><i class="bx bx-save"></i> บันทึกข้อมูล</button>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->
@endsection

{{-- page scripts --}}
@section('page-scripts')
    <script>
        $(document).ready(function () {
            $('.submit-button').click(function () {
                const form = $(this).attr('submit');
                if (form) {
                    $('#' + form).submit();
                }
            });
        });
    </script>
@endsection
