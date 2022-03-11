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
        <div class="row">
            <div class="col-xl-1"></div>

            <div class="col-sm-6 col-xl-2 col-12 mb-3">
                <div class="card mb-0">
                    <div class="card-header pb-50">
                        <h4 class="card-title">รอดำเนินการ</h4>
                    </div>
                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="sales-item-name">
                                <p class="mb-0">จำนวนคำร้อง</p>
                            </div>
                            <h6 class="mb-0">{{ $report['wait_for_action'] }}</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="sales-item-name">
                                <p class="mb-0">ระยะเวลาเฉลี่ย</p>
                                <small class="text-muted">ที่ใช้ในการดำเนินการแต่ละขั้นตอน (วัน)</small>
                            </div>
                            <h6 class="mb-0">794</h6>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="progress progress-bar-success progress-sm mt-50 mb-md-50">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $report['wait_for_action'] / $report['all'] * 100 }}" style="width:{{ $report['wait_for_action'] / $report['all'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-2 col-12 mb-3">
                <div class="card mb-0">
                    <div class="card-header pb-50">
                        <h4 class="card-title">สำรวจ</h4>
                    </div>
                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="sales-item-name">
                                <p class="mb-0">จำนวนคำร้อง</p>
                            </div>
                            <h6 class="mb-0">{{ $report['survey'] }}</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="sales-item-name">
                                <p class="mb-0">ระยะเวลาเฉลี่ย</p>
                                <small class="text-muted">ที่ใช้ในการดำเนินการแต่ละขั้นตอน (วัน)</small>
                            </div>
                            <h6 class="mb-0">794</h6>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="progress progress-bar-info progress-sm mt-50 mb-md-50">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $report['survey'] / $report['all'] * 100 }}" style="width:{{ $report['survey'] / $report['all'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-2 col-12 mb-3">
                <div class="card mb-0">
                    <div class="card-header pb-50">
                        <h4 class="card-title">จัดทำแผนผัง/ประมาณการค่าใช้จ่าย</h4>
                    </div>
                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="sales-item-name">
                                <p class="mb-0">จำนวนคำร้อง</p>
                            </div>
                            <h6 class="mb-0">{{ $report['estimate'] }}</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="sales-item-name">
                                <p class="mb-0">ระยะเวลาเฉลี่ย</p>
                                <small class="text-muted">ที่ใช้ในการดำเนินการแต่ละขั้นตอน (วัน)</small>
                            </div>
                            <h6 class="mb-0">794</h6>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="progress progress-bar-warning progress-sm mt-50 mb-md-50">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $report['estimate'] / $report['all'] * 100 }}" style="width:{{ $report['estimate'] / $report['all'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-2 col-12 mb-3">
                <div class="card mb-0">
                    <div class="card-header pb-50">
                        <h4 class="card-title">อนุมัติแจ้งค่าใช้จ่าย</h4>
                    </div>
                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="sales-item-name">
                                <p class="mb-0">จำนวนคำร้อง</p>
                            </div>
                            <h6 class="mb-0">{{ $report['approve'] }}</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="sales-item-name">
                                <p class="mb-0">ระยะเวลาเฉลี่ย</p>
                                <small class="text-muted">ที่ใช้ในการดำเนินการแต่ละขั้นตอน (วัน)</small>
                            </div>
                            <h6 class="mb-0">786</h6>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="progress progress-bar-primary progress-sm mt-50 mb-md-50">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $report['approve'] / $report['all'] * 100 }}" style="width:{{ $report['approve'] / $report['all'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-2 col-12 mb-3">
                <div class="card mb-0">
                    <div class="card-header pb-50">
                        <h4 class="card-title">อนุมัติแจ้งค่าใช้จ่าย</h4>
                    </div>
                    <div class="card-body py-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="sales-item-name">
                                <p class="mb-0">รับชำระเงิน</p>
                            </div>
                            <h6 class="mb-0">{{ $report['payment'] }}</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="sales-item-name">
                                <p class="mb-0">ระยะเวลาเฉลี่ย</p>
                                <small class="text-muted">ที่ใช้ในการดำเนินการแต่ละขั้นตอน (วัน)</small>
                            </div>
                            <h6 class="mb-0">794</h6>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="progress progress-bar-danger progress-sm mt-50 mb-md-50">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $report['payment'] / $report['all'] * 100 }}" style="width:{{ $report['payment'] / $report['all'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <td class="text-right p-0"><a href="{{ route('meters.edit', $meter) }}" class="btn btn-icon btn-outline-primary"><i class="bx bx-edit-alt"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No records</td>
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
