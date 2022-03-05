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
                    <div class="card-header">
                        <h4 class="card-title">เพิ่ม/แก้ไขข้อมูล งานขยายเขตระบบจำหน่ายไฟฟ้า</h4>
                    </div>
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                <div class="d-flex align-items-center"><i class="bx bx-like"></i><span>{!! session()->get('success') !!}</span></div>
                            </div>
                        @endif
                        <form class="form form-horizontal" method="POST" action="{{ ($isCreate)? route('meters.store') : route('meters.update', $meter) }}">
                            @csrf
                            @if(!$isCreate)
                                @method('PUT')
                            @endif
                            <div class="form-body">
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>เลขที่คำร้อง</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="document_number" placeholder="เลขที่คำร้อง" value="{{ $meter->document_number?? old('document_number') }}">
                                    </div>

                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>วันที่ยื่นคำร้อง</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="document_date" placeholder="วันที่ยื่นคำร้อง" value="{{ $meter->document_date?? old('document_date') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ชื่อ-นามสกุล</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="customer_name" placeholder="ชื่อ-นามสกุล" value="{{ $meter->customer_name?? old('customer_name') }}">
                                    </div>

                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>เบอร์โทรศัพท์</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="text" class="form-control" name="customer_phone" placeholder="เบอร์โทรศัพท์" value="{{ $meter->customer_phone?? old('customer_phone') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ประเภทงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="job_type_id">
                                            @forelse($job_types as $job_type)
                                                <option value="{{ $job_type->id }}" {{ ((isset($meter->job_type_id) && $meter->job_type_id === $job_type->id) || old('job_type_id') === $job_type->id)? 'selected':'' }}>{{ $job_type->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>หม้อแปลง ขนาด</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="transformer_id">
                                            @forelse($transformers as $transformer)
                                                <option value="{{ $transformer->id }}" {{ ((isset($meter->transformer_id) && $meter->transformer_id === $transformer->id) || old('transformer_id') === $transformer->id)? 'selected':'' }}>{{ $transformer->description }}</option>
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
                                        <input type="text" class="form-control" name="job_number" placeholder="หมายเลขงาน" value="{{ $meter->job_number?? old('job_number') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ชื่อผู้สำรวจ</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="survey_user_id">
                                            @forelse($pea_staffs as $pea_staff)
                                                <option value="{{ $pea_staff->id }}" {{ ((isset($meter->survey_user_id) && $meter->survey_user_id === $pea_staff->id) || old('survey_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
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
                                        <select class="form-control" name="job_amount_id">
                                            @forelse($job_amounts as $job_amount)
                                                <option value="{{ $job_amount->id }}" {{ ((isset($meter->job_amount_id) && $meter->job_amount_id === $job_amount->id) || old('job_amount_id') === $job_amount->id)? 'selected':'' }}>{{ $job_amount->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>สถานะงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="job_status_id">
                                            @forelse($job_statuses as $job_status)
                                                <option value="{{ $job_status->id }}" {{ ((isset($meter->job_status_id) && $meter->job_status_id === $job_status->id) || old('survey_user_id') === $job_status->id)? 'selected':'' }}>{{ $job_status->description }}</option>
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
                                        <input type="text" class="form-control" name="approve_location" placeholder="อนุมัติที่" value="{{ $meter->approve_location?? old('approve_location') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ลงวันที่</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="approve_date" placeholder="ลงวันที่" value="{{ $meter->approve_date?? old('approve_date') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>หมดกำหนดยื่นราคา</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="expires_quote_date" placeholder="หมดกำหนดยื่นราคา" value="{{ $meter->expires_quote_date?? old('expires_quote_date') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>วันที่ชำระเงิน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="payment_date" placeholder="วันที่ชำระเงิน" value="{{ $meter->payment_date?? old('payment_date') }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ผบค. ส่งงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="service_final_date" placeholder="ผบค. ส่งงาน" value="{{ $meter->service_final_date?? old('service_final_date') }}">
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle"></div>
                                    <div class="col-md-4 vertical-middle">
                                        <fieldset>
                                            <div class="checkbox">
                                                <input type="checkbox" class="checkbox-input" id="no_payment" name="no_payment" value="1" {{ ((isset($meter->no_payment) && $meter->no_payment) || old('no_payment'))? 'checked':'' }}>
                                                <label for="no_payment">ไม่มีค่าใช้จ่ายเรียกเก็บจากผู้ใช้ไฟ</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mt-1">
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-1"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
                                        <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
                                        <button type="reset" class="btn btn-light-secondary">คืนค่าเริ่มต้น</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section end -->
@endsection
