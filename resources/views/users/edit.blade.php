@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users Edit')
{{-- vendor styles --}}

{{-- page styles --}}
@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection

@section('content')
    <!-- users edit start -->
    <section class="users-edit">
        <div class="card">
            <div class="card-body">
                <!-- users edit media object start -->
                <div class="media mb-2">
                    <a class="mr-2" href="javascript:void(0);">
                        <img src="{{asset('images/portrait/small/avatar-s-26.jpg')}}" alt="users avatar"
                             class="users-avatar-shadow rounded-circle" height="64" width="64">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Avatar</h4>
                        <div class="col-12 px-0 d-flex">
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary mr-25">Change</a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-secondary">Reset</a>
                        </div>
                    </div>
                </div>
                <!-- users edit media object ends -->
                <!-- users edit account form start -->
                <form class="form-validate" action="{{ empty($user)? route('users.store') : route('users.update', $user) }}" method="POST" autocomplete="off">
                    @csrf
                    @if (!empty($user))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name"
                                           value="{{ old('name', $user->name ?? '') }}"
                                           name="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" placeholder="Email"
                                           value="{{ old('email', $user->email ?? '') }}"
                                           name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>PEAs</label>
                                <select class="form-control" name="pea_id" required>
                                    @foreach($peas as $pea)
                                        <option value="{{ $pea->id }}" {{ ((int)old('pea_id', $user->pea_id ?? 0) === $pea->id) ? 'selected' : '' }}>{{ $pea->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <label>รหัสผ่าน</label>
                                    <input type="password" class="form-control" placeholder="Password"
                                           autocomplete="off" name="new_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <label>ยืนยันรหัสผ่าน</label>
                                    <input type="password" class="form-control" placeholder="Password Confirmation"
                                           autocomplete="off" name="new_password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
                            <button type="reset" class="btn btn-light mb-1 mb-sm-0 mr-0 mr-sm-1">คืนค่าเริ่มต้น</button>
                            <button type="submit" class="btn btn-primary glow"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
                <!-- users edit account form ends -->
            </div>
        </div>
    </section>
    <!-- users edit ends -->
@endsection
