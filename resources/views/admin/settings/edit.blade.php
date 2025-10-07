@extends('layouts.admin')
@section('content')




<div class="nk-content ">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head">
                        <div class="nk-block-head-between flex-wrap gap g-2 align-items-start">
                            <div class="nk-block-head-content">
                                <div class="d-flex flex-column flex-md-row align-items-md-center">
                                    <div class="media media-huge media-circle"><img
                                            src="{{ asset('assets/front/img/logo/logo-black.png') }}" class="img-thumbnail" alt="">
                                    </div>
                                    <div class="mt-3 mt-md-0 ms-md-3">
                                        <h3 class="title mb-1">{{ Auth::guard('admin')->user()->name }}</h3><span
                                            class="small">{{ Auth::guard('admin')->user()->email }}</span>
                                        <ul class="nk-list-option pt-1">
                                            <li><em class="icon ni ni-map-pin"></em><span
                                                    class="small">{{ config('web.address') }}</span></li>
                                            <li><em class="icon ni ni-building"></em><span
                                                    class="small">{{ config('web.title') }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="nk-block-head-between gap g-2">
                        <div class="gap-col">
                            <ul class="nav nav-pills nav-pills-border gap g-3">
                                <li class="nav-item"><button class="nav-link active"
                                        data-bs-toggle="tab" data-bs-target="#tab-1" type="button">
                                        Account </button></li>

                            </ul>
                        </div>

                    </div>
                </div>
                @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 12px; border-left: 5px solid #28a745; border-radius: 4px; margin-bottom: 10px;">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div style="background: #f8d7da; color: #721c24; padding: 12px; border-left: 5px solid #dc3545; border-radius: 4px; margin-bottom: 10px;">
                    {{ session('error') }}
                </div>
                @endif

                @if($errors->any())
                <div style="background: #fff3cd; color: #856404; padding: 12px; border-left: 5px solid #ffc107; border-radius: 4px; margin-bottom: 10px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <div class="nk-block">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="tab-1" tabindex="0">
                            <div class="card card-gutter-md">
                                <div class="card-body">
                                    <div class="bio-block">
                                        <h4 class="bio-block-title mb-4">Edit Profile</h4>
                                        <form method="POST" action="{{ route('admin.settings.update') }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label for="firstname"
                                                            class="form-label">User Name</label>
                                                        <div class="form-control-wrap"> <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $admin->name) }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label for="lastname"
                                                            class="form-label">Email</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $admin->email) }}" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12"><button class="btn btn-primary"
                                                        type="submit">Update Profile</button></div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="card card-gutter-md">
                                <div class="card-body">
                                    <div class="bio-block">
                                        <h4 class="bio-block-title mb-4">Chnage Password</h4>
                                        <form method="POST" action="{{ route('admin.settings.password') }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-group"><label for="firstname"
                                                            class="form-label">Current Password</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control" type="password" name="current_password" id="current_password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label for="lastname"
                                                            class="form-label">New Password</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control" type="password" name="new_password" id="new_password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group"><label for="lastname"
                                                            class="form-label">Confirm Password</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12"><button class="btn btn-primary"
                                                        type="submit">Update password</button></div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()