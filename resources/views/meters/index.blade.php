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
        <div class="users-list-table">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('meters.create') }}" class="btn btn-primary mr-1"><i class="bx bx-plus"></i> เพิ่มข้อมูล</a>
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
                                    <td><a href="{{ route('meters.edit', $meter) }}" class="btn btn-icon btn-outline-primary"><i class="bx bx-edit-alt"></i></a></td>
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

    <script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

@endsection
