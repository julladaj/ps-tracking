@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Meter List')
{{-- vendor styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/app-users.css') }}">
@endsection

@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="row match-height">
            <div class="col-xl-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="avatar bg-rgba-{{ $over_report['color'] }} m-0 p-25 mr-75 mr-xl-2">
                                <div class="avatar-content">
                                    <i class="bx bxs-error text-{{ $over_report['color'] }} font-medium-2"></i>
                                </div>
                            </div>
                            <div class="total-amount">
                                <h5 class="mb-0">0 คำร้อง</h5>
                                <small class="text-muted">จัดทำแผนผัง/ประมาณการค่าใช้จ่าย <code>เกินกำหนด</code></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <div class="avatar bg-rgba-{{ $over_report['color'] }} m-0 p-25 mr-75 mr-xl-2">
                                <div class="avatar-content">
                                    <i class="bx bxs-error text-{{ $over_report['color'] }} font-medium-2"></i>
                                </div>
                            </div>
                            <div class="total-amount">
                                <h5 class="mb-0"><a href="{{ $over_report['overdue_url'] }}">{{ $over_report['overdue'] }} คำร้อง</a></h5>
                                <small class="text-muted"><code>หมดกำหนด</code> ยืนราคา @if($request->get('overdue')) ( <a href="{{ route('meters.index') }}">แสดงทั้งหมด</a> ) @endif</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row match-height">
            <div class="col-sm-6 col-xl-2 col-12 mb-3">
                <div class="card mb-0">
                    <div class="card-header pb-50">
                        <h4 class="card-title"><a href="{{ $over_report['job_status_url'] }}">สถานะทั้งหมด</a></h4>
                    </div>
                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="sales-item-name">
                                <p class="mb-0">จำนวนคำร้อง</p>
                            </div>
                            <h6 class="mb-0"><a href="{{ $over_report['job_status_url'] }}">{{ $over_report['count'] }}</a></h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="sales-item-name">
                                <p class="mb-0">ระยะเวลาเฉลี่ย</p>
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
                            <h4 class="card-title"><a href="{{ $value['url'] }}">{{ __('meter.job_status.' . $key) }}</a></h4>
                        </div>
                        <div class="card-body py-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="sales-item-name">
                                    <p class="mb-0">จำนวนคำร้อง</p>
                                </div>
                                <h6 class="mb-0"><a href="{{ $value['url'] }}">{{ $value['count'] }}</a></h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="sales-item-name">
                                    <p class="mb-0">ระยะเวลาเฉลี่ย</p>
                                    <small class="text-muted">ที่ใช้ในการดำเนินการแต่ละขั้นตอน (วัน)</small>
                                </div>
                                <h6 class="mb-0">{{ $value['avg'] }}</h6>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <div class="progress progress-bar-{{ $value['color'] }} progress-sm mt-50 mb-md-50">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ ($over_report['count'])? $value['count'] / $over_report['count'] * 100 : 0 }}"
                                     style="width:{{ ($over_report['count'])? $value['count'] / $over_report['count'] * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="users-list-table">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">PS Tracking</h5>
                    <div class="heading-elements">
                        <a href="{{ route('meters.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> เพิ่มข้อมูล</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">

                        @include('components.metersPageSizeSelector')

                        <table class="table">
                            <thead>
                            <tr>
                                <th>@sortablelink('document_number', 'เลขที่คำร้อง', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('document_date', 'วันที่ยื่นคำร้อง', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('customer_name', 'ชื่อ-นามสกุล', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('customer_phone', 'เบอร์โทร', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('job_type_id', 'ประเภทงาน', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('survey_user_id', 'ชื่อผู้สำรวจ', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('job_status_id', 'สถานะงาน', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('job_number', 'หมายเลขงาน', null, ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('comment', 'หมายเหตุ', null, ['rel' => 'nofollow'])</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($meters as $meter)
                                <tr>
                                    <td><a href="{{ route('meters.edit', $meter) }}">{{ $meter->document_number?? '' }}</a></td>
                                    <td>{{ buddhismDate($meter->document_date) }}</td>
                                    <td>{{ $meter->customer_name }}</td>
                                    <td>{{ $meter->customer_phone }}</td>
                                    <td>{{ $meter->job_type->description }}</td>
                                    <td>{{ $meter->pea_staff->name }}</td>
                                    <td>{{ $meter->job_status->description }}</td>
                                    <td>{{ $meter->job_number }}</td>
                                    <td>{{ $meter->comment }}</td>
                                    <td class="text-right p-0"><a href="{{ route('meters.edit', $meter) }}" class="btn btn-icon btn-outline-primary"><i class="bx bx-edit-alt"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ __('meter.no_record') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                    {{ $meters->withQueryString()->links('components.pagination') }}
                </div>
            </div>
        </div>
    </section>
    <!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
    <script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>

    <script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('vendors/js/extensions/dragula.min.js')}}"></script>

    <script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>

    {{--    <script src="{{asset('js/scripts/pages/dashboard-analytics.js')}}"></script>--}}
@endsection

@push('scripts')

@endpush
