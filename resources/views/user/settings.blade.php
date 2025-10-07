@extends('layouts.user')
@section('content')

<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-4">
                            <div class="page-title-content">
                                <h3>Settings</h3>
                                <p class="mb-2">Manage your account settings</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="breadcrumbs">
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                <span><i class="ri-arrow-right-s-line"></i></span>
                                <a href="#">Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xxl-12 col-xl-12">
                <div class="settings-menu">
                    <a href="{{ route('user.settings') }}" class="active">Profile</a>
                    <a href="#">Application</a>
                    <a href="#">Security</a>
                    <a href="#">Activity</a>
                    <a href="#">Payment Method</a>
                </div>
                
                <div class="row">
                    @if(session('success'))
                        <div class="col-12">
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="col-12">
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User Profile</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3">
                                        <div class="col-xxl-12 col-12 mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
                                            @error('fullname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-12 col-12 mb-3">
                                            <div class="d-flex align-items-center">
                                                <img class="me-3 rounded-circle me-0 me-sm-3" 
                                                     src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/profile/3.png') }}" 
                                                     width="55" height="55" alt="Profile">
                                                <div class="media-body">
                                                    <h4 class="mb-0">{{ $user->fullname }}</h4>
                                                    <p class="mb-0">Max file size is 2MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-12 col-12 mb-3">
                                            <label class="form-label">Profile Image</label>
                                            <input type="file" class="form-control" name="profile_image" accept="image/*">
                                            @error('profile_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-12 col-12 mb-3">
                                            <button class="btn btn-primary" type="submit">Save Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Account Settings</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.email.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button class="btn btn-primary" type="submit">Update Email</button>
                                        </div>
                                    </div>
                                </form>
                                
                                <hr>
                                
                                <form action="{{ route('user.password.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" class="form-control" name="current_password" required>
                                            @error('current_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="new_password" required>
                                            @error('new_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" name="new_password_confirmation" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button class="btn btn-primary" type="submit">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Personal Information</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Phone Number">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Occupation</label>
                                            <input type="text" class="form-control" name="occupation" value="{{ old('occupation', $user->occupation) }}" placeholder="Occupation">
                                            @error('occupation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}" placeholder="123, Central Square, Brooklyn">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city" value="{{ old('city', $user->city) }}" placeholder="New York">
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" name="state" value="{{ old('state', $user->state) }}" placeholder="State">
                                            @error('state')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" name="country" value="{{ old('country', $user->country) }}" placeholder="Country">
                                            @error('country')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                            @error('date_of_birth')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                            <label class="form-label">Annual Income (₦)</label>
                                            <input type="number" class="form-control" name="annual_income" value="{{ old('annual_income', $user->annual_income) }}" placeholder="Annual Income" step="0.01">
                                            @error('annual_income')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary pl-5 pr-5">Save Personal Information</button>
                                        </div>
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

@endsection