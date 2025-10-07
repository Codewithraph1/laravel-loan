@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">User Details</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $user->fullname }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back to Users</a>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label class="form-label">Full Name</label>
                                            <p class="form-control-static">{{ $user->fullname }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Email</label>
                                            <p class="form-control-static">{{ $user->email }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Phone</label>
                                            <p class="form-control-static">{{ $user->phone ?: 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Account Number</label>
                                            <p class="form-control-static">{{ $user->account_number }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Date of Birth</label>
                                            <p class="form-control-static">{{ $user->date_of_birth ? $user->date_of_birth->format('M d, Y') : 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Occupation</label>
                                            <p class="form-control-static">{{ $user->occupation ?: 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Account Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label class="form-label">Balance</label>
                                            <p class="form-control-static">₦{{ number_format($user->balance, 2) }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Annual Income</label>
                                            <p class="form-control-static">{{ $user->annual_income ? '$' . number_format($user->annual_income, 2) : 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Credit Score</label>
                                            <p class="form-control-static">{{ $user->credit_score }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Status</label>
                                            <p>
                                                <span class="badge text-bg-{{ $user->status == 'active' ? 'success' : ($user->status == 'suspended' ? 'warning' : 'danger') }}-soft">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Verified</label>
                                            <p>
                                                <span class="badge text-bg-{{ $user->is_verified ? 'success' : 'warning' }}-soft">
                                                    {{ $user->is_verified ? 'Verified' : 'Pending' }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Joined Date</label>
                                            <p class="form-control-static">{{ $user->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Address Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label class="form-label">Address</label>
                                            <p class="form-control-static">{{ $user->address ?: 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">City</label>
                                            <p class="form-control-static">{{ $user->city ?: 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">State</label>
                                            <p class="form-control-static">{{ $user->state ?: 'N/A' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Country</label>
                                            <p class="form-control-static">{{ $user->country ?: 'N/A' }}</p>
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
</div>

@endsection