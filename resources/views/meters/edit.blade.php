@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','แก้ไขข้อมูล')

@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/wizard.css')}}">
    <style>
        .vertical-middle {
            margin: auto 0;
        }

        .wizard .steps ul li a .step {
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            text-align: center;
        }

        .wizard .steps ul li.overdue::after, .wizard .steps ul li.overdue::before {
            background-color: #FDAC41 !important;
        }

        .wizard .steps ul li.overdue a {
            color: #FDAC41 !important;
        }
    </style>
@endsection

@section('content')
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        @if(!$isCreate)
            <div class="row match-height">
                <div class="col-sm-6 col-xl-2 col-12 mb-3">
                    <div class="card mb-0">
                        <div class="card-header pb-50">
                            <h4 class="card-title">สถานะทั้งหมด</h4>
                        </div>
                        <div class="card-body py-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="sales-item-name">
                                    <p class="mb-0">ระยะเวลารวม</p>
                                    <small class="text-muted">ที่ใช้ในการดำเนินการแต่ละขั้นตอน (วัน)</small>
                                </div>
                                <h6 class="mb-0">{{ $over_report['job_status_avg'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($job_status_report as $key => $value)
                    <div class="col-sm-6 col-xl-2 col-12 mb-3">
                        <div class="card mb-0">
                            <div class="card-header pb-50">
                                <h4 class="card-title">{{ __('meter.job_status.' . $key) }}</h4>
                            </div>
                            <div class="card-body py-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="sales-item-name">
                                        <p class="mb-0">ระยะเวลา</p>
                                        <small class="text-muted">ที่ใช้ในการดำเนินการ (วัน)</small>
                                    </div>
                                    <h6 class="mb-0">{{ $value['avg'] }}</h6>
                                </div>
                            </div>
                            <div class="card-footer border-top">
                                <div class="progress progress-bar-{{ $value['color'] }} progress-sm mt-50 mb-md-50">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ ($over_report['job_status_avg'])? $value['avg'] / $over_report['job_status_avg'] * 100 : 0 }}"
                                         style="width:{{ ($over_report['job_status_avg'])? $value['avg'] / $over_report['job_status_avg'] * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <form class="form form-horizontal" id="form_meter" method="POST" action="{{ ($isCreate)? route('meters.store') : route('meters.update', $meter) }}">
            <div class="wizard">
                <div class="steps clearfix">
                    <ul role="tablist">
                        @foreach($job_status_report as $key => $value)
                            @if ($value['payment'] === false)
                                <li role="tab"
                                    class="{{ ($value['id'] === 1)? 'first' : '' }} {{ ($value['id'] === 4)? 'last' : '' }} {{ ($value['avg'] > $value['standard_days'])? 'overdue' : '' }} {{ ($is_current = ($meter->job_status_id === $value['id']))? 'current' : '' }} {{ ($is_pass = ($meter->job_status_id > $value['id']))? 'done' : '' }} {{ (!$is_current && !$is_pass)? 'disabled' : '' }}"
                                    aria-disabled="{{ ($meter->job_status_id >= $value['id'])? 'false' : 'true' }}"
                                    aria-selected="{{ ($meter->job_status_id >= $value['id'])? 'true' : 'false' }}"
                                >
                                    <a id="steps-uid-3-t-{{ $value['id'] }}"
                                       href="#steps-uid-3-h-{{ $value['id'] }}"
                                       aria-controls="steps-uid-3-p-{{ $value['id'] }}"
                                    >
                                        <span class="step"><i class="@if ($is_current) step-icon bx bx-time-five @elseif($meter->job_status_id > $value['id']) step-icon bx-check-circle bx @else step-icon @endif"></i></span>
                                        <span>{{ __('meter.job_status.' . $key) }} {{ $value['avg'] }} วัน<br><small>เวลามาตรฐาน {{ $value['standard_days'] }} วัน</small></span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row">
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
                                        <input type="date" class="form-control" name="meters[document_date]" placeholder="วันที่ยื่นคำร้อง" value="{{ $meter->document_date?? old('meters.document_date') }}" data-toggle="tooltip" data-placement="top"
                                               data-original-title="{{ buddhismDate($meter->document_date?? old('meters.document_date')) }}">
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
                                        <select class="form-control" name="meters[job_type_id]" id="job_type_id">
                                            @forelse($job_types as $job_type)
                                                <option value="{{ $job_type->id }}" {{ ((isset($meter->job_type_id) && $meter->job_type_id === $job_type->id) || old('meters.job_type_id') === $job_type->id)? 'selected':'' }}>{{ $job_type->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle meter-transformer">
                                        <label>หม้อแปลง ขนาด</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle meter-transformer">
                                        <select class="form-control" name="meters[transformer_id]">
                                            @forelse($transformers as $transformer)
                                                <option value="{{ $transformer->id }}" {{ ((isset($meter->transformer_id) && $meter->transformer_id === $transformer->id) || old('meters.transformer_id') === $transformer->id)? 'selected':'' }}>{{ $transformer->description }}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>สถานที่ขอใช้บริการ</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <select class="form-control" name="meters[requested_place_id]" id="requested_place_id">
                                            @forelse($requested_places as $requested_place)
                                                <option value="{{ $requested_place->id }}"
                                                        credit_terms="{{ $requested_place->credit_terms }}" {{ ((isset($meter->requested_place_id) && $meter->requested_place_id === $requested_place->id) || old('meters.requested_place_id') === $requested_place->id)? 'selected':'' }}>{{ $requested_place->description }}</option>
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
                                        <input type="date" class="form-control" id="approve_date" name="meters[approve_date]" placeholder="ลงวันที่" value="{{ $meter->approve_date?? old('meters.approve_date') }}" data-toggle="tooltip"
                                               data-placement="top" data-original-title="{{ buddhismDate($meter->approve_date?? old('meters.approve_date')) }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>หมดกำหนดยืนราคา</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" id="expires_quote_date" name="meters[expires_quote_date]" placeholder="หมดกำหนดยื่นราคา" value="{{ $meter->expires_quote_date?? old('meters.expires_quote_date') }}"
                                               readonly data-toggle="tooltip" data-placement="top" data-original-title="{{ buddhismDate($meter->expires_quote_date?? old('meters.expires_quote_date')) }}"/>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>วันที่ชำระเงิน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="meters[payment_date]" placeholder="วันที่ชำระเงิน" value="{{ $meter->payment_date?? old('meters.payment_date') }}" data-toggle="tooltip" data-placement="top"
                                               data-original-title="{{ buddhismDate($meter->payment_date?? old('meters.payment_date')) }}">
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ผบค. ส่งงาน</label>
                                    </div>
                                    <div class="col-md-4 form-group vertical-middle">
                                        <input type="date" class="form-control" name="meters[service_final_date]" placeholder="ผบค. ส่งงาน" value="{{ $meter->service_final_date?? old('meters.service_final_date') }}" data-toggle="tooltip"
                                               data-placement="top" data-original-title="{{ buddhismDate($meter->service_final_date?? old('meters.service_final_date')) }}">
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
                        </div>
                    </div>
                </div>
            </div>

            @if(!$isCreate)
                @if($meter->job_status_id >= 4)
                    <div class="wizard">
                        <div class="steps clearfix">
                            <ul role="tablist">
                                @foreach($job_status_report as $key => $value)
                                    @if ($value['payment'] === true)
                                        <li role="tab"
                                            class="{{ ($value['id'] === 4)? 'first' : '' }} {{ ($value['id'] === 5)? 'last' : '' }} {{ ($value['avg'] > $value['standard_days'])? 'overdue' : '' }} {{ ($is_current = ($meter->job_status_id === $value['id']))? 'current' : '' }} {{ ($is_pass = ($meter->job_status_id > $value['id']))? 'done' : '' }} {{ (!$is_current && !$is_pass)? 'disabled' : '' }}"
                                            aria-disabled="{{ ($meter->job_status_id >= $value['id'])? 'false' : 'true' }}"
                                            aria-selected="{{ ($meter->job_status_id >= $value['id'])? 'true' : 'false' }}"
                                        >
                                            <a id="steps-uid-3-t-{{ $value['id'] }}"
                                               href="#steps-uid-3-h-{{ $value['id'] }}"
                                               aria-controls="steps-uid-3-p-{{ $value['id'] }}"
                                            >
                                                <span class="step"><i class="@if ($is_current) step-icon bx bx-time-five @elseif($meter->job_status_id > $value['id']) step-icon bx-check-circle bx @else step-icon @endif"></i></span>
                                                <span>{{ __('meter.job_status.' . $key) }} {{ $value['avg'] }} วัน</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
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
                                            <input type="text" class="form-control" name="electric_expands[consumer_type]" placeholder="ลักษณะการใช้พลังงานไฟฟ้า"
                                                   value="{{ $meter->electric_expand->consumer_type?? old('electric_expands.consumer_type') }}">
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>สภาพภูมิประเทศ</label>
                                        </div>
                                        <div class="col-md-10 form-group vertical-middle">
                                            <select class="form-control" name="electric_expands[geo_id]">
                                                @forelse($geos as $geo)
                                                    <option value="{{ $geo->id }}" {{ ((isset($meter->electric_expand->geo_id) && $meter->electric_expand->geo_id === $geo->id) || old('electric_expands.geo_id') === $geo->id)? 'selected':'' }}>{{ $geo->description }}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>สภาพพื้นดิน</label>
                                        </div>
                                        <div class="col-md-10 form-group vertical-middle">
                                            <select class="form-control" name="electric_expands[env_earth_id]">
                                                @forelse($env_earths as $env_earth)
                                                    <option value="{{ $env_earth->id }}" {{ ((isset($meter->electric_expand->env_earth_id) && $meter->electric_expand->env_earth_id === $env_earth->id) || old('electric_expands.env_earth_id') === $env_earth->id)? 'selected':'' }}>{{ $env_earth->description }}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>สภาพต้นไม้ตามแนวขยายเขต</label>
                                        </div>
                                        <div class="col-md-4 form-group vertical-middle">
                                            <select class="form-control" name="electric_expands[env_tree_id]">
                                                @forelse($env_trees as $env_tree)
                                                    <option value="{{ $env_tree->id }}" {{ ((isset($meter->electric_expand->env_tree_id) && $meter->electric_expand->env_tree_id === $env_tree->id) || old('electric_expands.env_tree_id') === $env_tree->id)? 'selected':'' }}>{{ $env_tree->description }}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="electric_expands[env_tree_distant_km]" placeholder="กิโลเมตร" aria-describedby="env_tree_distant_km"
                                                           value="{{ $meter->electric_expand->env_tree_distant_km?? old('electric_expands.env_tree_distant_km') }}">
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
                                            <select class="form-control" name="electric_expands[reserved_forest_id]">
                                                @forelse($reserved_forests as $reserved_forest)
                                                    <option value="{{ $reserved_forest->id }}" {{ ((isset($meter->electric_expand->reserved_forest_id) && $meter->electric_expand->reserved_forest_id === $reserved_forest->id) || old('electric_expands.reserved_forest_id') === $reserved_forest->id)? 'selected':'' }}>{{ $reserved_forest->description }}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>นำรถยนต์เข้าปฏิบัติงาน</label>
                                        </div>
                                        <div class="col-md-4 form-group vertical-middle">
                                            <input type="text" class="form-control" name="electric_expands[working_with_car]" placeholder="นำรถยนต์เข้าปฏิบัติงาน"
                                                   value="{{ $meter->electric_expand->working_with_car?? old('electric_expands.working_with_car') }}">
                                        </div>
                                        <div class="col-md-1 text-right vertical-middle">
                                            <label>สภาพชุมชน</label>
                                        </div>
                                        <div class="col-md-5 form-group vertical-middle">
                                            <select class="form-control" name="electric_expands[env_community_id]">
                                                @forelse($env_communities as $env_community)
                                                    <option value="{{ $env_community->id }}" {{ ((isset($meter->electric_expand->env_community_id) && $meter->electric_expand->env_community_id === $env_community->id) || old('electric_expands.env_community_id') === $env_community->id)? 'selected':'' }}>{{ $env_community->description }}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>รับพลังงานไฟฟ้าจากหม้อแปลง PEA</label>
                                        </div>
                                        <div class="col-md-4 form-group vertical-middle">
                                            <input type="text" class="form-control" name="electric_expands[transformer_pea_no]" placeholder="รับพลังงานไฟฟ้าจากหม้อแปลง PEA"
                                                   value="{{ $meter->electric_expand->transformer_pea_no?? old('electric_expands.transformer_pea_no') }}">
                                        </div>
                                        <div class="col-md-1 text-right vertical-middle">
                                            <label>ขนาด</label>
                                        </div>
                                        <div class="col-md-1 form-group vertical-middle">
                                            <select class="form-control" name="electric_expands[transformer_id]">
                                                @forelse($transformers as $transformer)
                                                    <option value="{{ $transformer->id }}" {{ ((isset($meter->electric_expand->transformer_id) && $meter->electric_expand->transformer_id === $transformer->id) || old('electric_expands.transformer_id') === $transformer->id)? 'selected':'' }}>{{ $transformer->description }} kVA</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-1 text-right vertical-middle">
                                            <label>ระบบ</label>
                                        </div>
                                        <div class="col-md-3 form-group vertical-middle">
                                            <input type="text" class="form-control" name="electric_expands[transformer_type]" placeholder="ระบบ" value="{{ $meter->electric_expand->transformer_type?? old('electric_expands.transformer_type') }}">
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>โวลท์ จากสถานี</label>
                                        </div>
                                        <div class="col-md-4 form-group vertical-middle">
                                            <select class="form-control" name="electric_expands[station_id]">
                                                @forelse($stations as $station)
                                                    <option value="{{ $station->id }}" {{ ((isset($meter->electric_expand->station_id) && $meter->electric_expand->station_id === $station->id) || old('electric_expands.station_id') === $station->id)? 'selected':'' }}>{{ $station->description }}</option>
                                                @empty
                                                    <option></option>
                                                @endforelse
                                            </select>
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
                                                    <input type="number" class="form-control" name="electric_expands[feeder_distant_km]" placeholder="กิโลเมตร" aria-describedby="feeder_distant_km"
                                                           value="{{ $meter->electric_expand->feeder_distant_km?? old('electric_expands.feeder_distant_km') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="feeder_distant_km">กม.</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>เรียกเก็บจากผู้ใช้ไฟ</label>
                                        </div>
                                        <div class="col-md-4 vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <div class="checkbox">
                                                                <input type="checkbox" class="checkbox__input" id="has_payment" name="meters[has_payment]"
                                                                       value="1" {{ ((isset($meter->has_payment) && $meter->has_payment) || old('meters.has_payment'))? 'checked':'' }}>
                                                                <label for="has_payment"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control" name="meters[payment_request]" placeholder="เรียกเก็บจากผู้ใช้ไฟ" aria-describedby="payment_request"
                                                           value="{{ $meter->payment_request?? old('meters.payment_request') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="payment_request">บาท</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>กำหนดยืนราคา</label>
                                        </div>
                                        <div class="col-md-4 vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="meters[paid_credit_terms]" placeholder="กำหนดยืนราคา" aria-describedby="paid_credit_terms"
                                                           value="{{ $meter->paid_credit_terms?? old('meters.paid_credit_terms') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="paid_credit_terms">เดือน</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>ผู้ใช้ไฟได้ชำระ</label>
                                        </div>
                                        <div class="col-md-4 vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <div class="checkbox">
                                                                <input type="checkbox" class="checkbox__input" id="paid" name="meters[paid]"
                                                                       value="1" {{ ((isset($meter->paid) && $meter->paid) || old('meters.paid'))? 'checked':'' }}>
                                                                <label for="paid"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control" name="meters[paid_amount]" placeholder="ผู้ใช้ไฟได้ชำระ" aria-describedby="paid_amount"
                                                           value="{{ $meter->paid_amount?? old('meters.paid_amount') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="paid_amount">บาท</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>ใบเสร็จรับเงินเลขที่</label>
                                        </div>
                                        <div class="col-md-4 vertical-middle">
                                            <input type="text" class="form-control" name="meters[receive_no]" placeholder="ใบเสร็จรับเงินเลขที่" value="{{ $meter->receive_no?? old('meters.receive_no') }}">
                                        </div>

                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>ลงวันที่</label>
                                        </div>
                                        <div class="col-md-4 vertical-middle">
                                            <input type="date" class="form-control" name="meters[receive_date]" placeholder="ลงวันที่" value="{{ $meter->receive_date?? old('meters.receive_date') }}" data-toggle="tooltip" data-placement="top"
                                                   data-original-title="{{ buddhismDate($meter->receive_date?? old('meters.receive_date')) }}">
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>ผู้เสนอขออนุมัติ</label>
                                        </div>
                                        <div class="col-md-4 form-group vertical-middle">
                                            <select class="form-control" name="meters[request_approve_user_id]">
                                                <option></option>
                                                @forelse($pea_staffs as $pea_staff)
                                                    <option value="{{ $pea_staff->id }}" {{ ((isset($meter->request_approve_user_id) && $meter->request_approve_user_id === $pea_staff->id) || old('meters.request_approve_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>ผู้อนุมัติ</label>
                                        </div>
                                        <div class="col-md-4 form-group vertical-middle">
                                            <select class="form-control" name="meters[approve_user_id]">
                                                <option></option>
                                                @forelse($pea_staffs as $pea_staff)
                                                    <option value="{{ $pea_staff->id }}" {{ ((isset($meter->approve_user_id) && $meter->approve_user_id === $pea_staff->id) || old('meters.approve_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
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
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
        </form>
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

            $(document).on('change', '#job_type_id', function () {
                check_job_type_id($(this).val());
            });

            $(document).on('change', '#requested_place_id', function () {
                update_credit_term($('option:selected', this).attr('credit_terms'));
            });

            $(document).on('change', '#approve_date', function () {
                update_credit_term($('option:selected', '#requested_place_id').attr('credit_terms'));
            });

            $(document).on('change', 'input[type="date"]', function () {
                const $this = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('api.convertLocaleDate') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        value: $this.val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        $this.attr('data-original-title', data.localDate)
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            function check_job_type_id(job_type_id) {
                if (job_type_id === "4" || job_type_id === "5") {
                    $('.meter-transformer').show();
                } else {
                    $('.meter-transformer').hide();
                }
            }

            function update_credit_term(credit_terms) {
                const date = new Date($("#approve_date").val()), days = parseInt(credit_terms, 10);

                if (!isNaN(date.getTime())) {
                    date.setDate(date.getDate() + days);
                    $("#expires_quote_date").val(date.toInputFormat());
                    $("#expires_quote_date").trigger('change');
                }
            }

            Date.prototype.toInputFormat = function () {
                const yyyy = this.getFullYear().toString();
                const mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
                const dd = this.getDate().toString();
                return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
            };

            check_job_type_id($('#job_type_id').val());
            update_credit_term($('option:selected', '#requested_place_id').attr('credit_terms'));
        });
    </script>
@endsection
