@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users List')
{{-- vendor styles --}}
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')
    <!-- users list start -->
    <section class="users-list-wrapper">
        <div class="users-list-table">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">ข้อมูลผู้ใช้</h5>
                    <div class="heading-elements">
                        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> เพิ่มข้อมูล</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">

                        @include('components.usersPageSizeSelector')

                        <table class="table">
                            <thead>
                            <tr>
                                <th>@sortablelink('id', '#', null,  ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('email', 'Email', null,  ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('name', 'Name', null,  ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('pea_id', 'PEA', null,  ['rel' => 'nofollow'])</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ route('users.edit', $user) }}">{{ $user->email }}</a></td>
                                    <td><a href="{{ route('users.edit', $user) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->pea->name }}</td>
                                    <td>
                                        @foreach ($user->getRoleNames() as $role)
                                            <div class="badge badge-light-primary">{{ $role }}</div>
                                        @endforeach
                                    </td>
                                    <td><a href="{{ route('users.edit', $user) }}"><i class="bx bx-edit-alt"></i></a></td>
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
                    {{ $users->withQueryString()->links('components.pagination') }}
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
