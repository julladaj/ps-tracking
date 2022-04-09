@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','แก้ไขข้อมูล')

@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
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
            background-color: var(--warning) !important;
        }

        .wizard .steps ul li.overdue a {
            color: var(--warning) !important;
        }

        body.dark-layout .show_on_approve_date label, .show_on_approve_date label {
            color: var(--danger);
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
            @if(!$isCreate)
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
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
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

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#service_department_tab" aria-controls="service_department_tab" role="tab"
                                       aria-selected="true">
                                        <i class="bx bx-home align-middle"></i>
                                        <span class="align-middle">แผนกบริการลูกค้า</span>
                                    </a>
                                </li>
                                @if(!$isCreate)
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#meter_approve_tab" aria-controls="meter_approve_tab" role="tab"
                                           aria-selected="false">
                                            <i class="bx bx-user align-middle"></i>
                                            <span class="align-middle">ขออนุมัติ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#manual_payment_tab" aria-controls="manual_payment_tab" role="tab"
                                           aria-selected="false">
                                            <i class="bx bx-dollar align-middle"></i>
                                            <span class="align-middle">ค่าใช้จ่าย</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="about-tab" data-toggle="tab" href="#payment_tab" aria-controls="payment_tab" role="tab"
                                           aria-selected="false">
                                            <i class="bx bx-message-square align-middle"></i>
                                            <span class="align-middle">แจ้งค่าใช้จ่าย</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="service_department_tab" aria-labelledby="home-tab" role="tabpanel">
                                    @include('meters.include.service_department')
                                </div>
                                @if(!$isCreate)
                                    <div class="tab-pane" id="meter_approve_tab" aria-labelledby="profile-tab" role="tabpanel">
                                        @include('meters.include.meter_approve')
                                    </div>
                                    <div class="tab-pane" id="manual_payment_tab" aria-labelledby="profile-tab" role="tabpanel">
                                        @include('meters.include.payment_manual')
                                    </div>
                                    <div class="tab-pane" id="payment_tab" aria-labelledby="about-tab" role="tabpanel">
                                        @include('meters.include.payment')
                                    </div>
                                @endif
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
            @endif
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

        });
    </script>
@endsection
