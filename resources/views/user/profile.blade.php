@extends('layouts.user')
@section('content')

<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-4">
                    <div class="page-title-content">
                        <h3>Profile</h3>
                        <p class="mb-2"> {{ config('web.title') }}</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs">
                        <a href="{{ route('user.dashboard') }}">Home</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="#">Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div class="card welcome-profile">
                    <div class="card-body">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/profile/3.png') }}" alt="Profile Image" class="rounded-circle" width="100" height="100">
                        <h4>Welcome, {{ $user->fullname }}!</h4>
                        <p>Looks like you are {{ $user->is_verified ? 'verified' : 'not verified' }} yet. Verify yourself to use the full potential of our platform.</p>
                        <ul>
                            
                            <li>
                                <a href="#">
                                    <span class="{{ $user->two_fa_pin ? 'verified' : 'not-verified' }}">
                                        <i class="ri-shield-check-line"></i>
                                    </span>
                                    Two-factor authentication (2FA)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Make Transactions</h4>
                    </div>
                    <div class="card-body">
                        <div class="app-link text-center">
                            <h5>Quick Actions</h5>
                            <p>Manage your account with ease — apply for a loan or check your wallet balance instantly.</p>

                            <!-- Apply for Loan -->
                            <a href="" class="btn btn-primary me-2">
                                <i class="fas fa-hand-holding-usd"></i> Apply for Loan
                            </a>

                            <!-- Check Wallet -->
                            <a href="" class="btn btn-success">
                                <i class="fas fa-wallet"></i> Check Wallet
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xxl-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">VERIFY & UPGRADE</h4>
                    </div>
                    <div class="card-body">
                        <h5>Account Status :
                            <span class="text-{{ $user->is_verified ? 'success' : 'warning' }}">
                                {{ $user->is_verified ? 'Verified' : 'Pending' }}
                                <i class="icofont-{{ $user->is_verified ? 'check-circled' : 'warning' }}"></i>
                            </span>
                        </h5>
                        <p>
                            {{ $user->is_verified 
                                ? 'Your account is verified. You can now access all features.' 
                                : 'Your account is unverified. Get verified to enable funding, trading, and withdrawal.' 
                            }}
                        </p>
                        @if(!$user->is_verified)
                        <a href="#" class="btn btn-primary">Get Verified</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Earn 30% Commission</h4>
                    </div>
                    <div class="card-body">
                        <p>Refer your friends and earn 30% of their trading fees.</p>
                        <a href="#" class="btn btn-primary">Referral Program</a>
                    </div>
                </div>
            </div>

            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header flex-row d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Information</h4>
                        <a class="btn btn-primary" href="{{ route('user.settings') }}">Edit</a>
                    </div>
                    <div class="card-body">
                        <form class="row">
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>USER ID</span>
                                    <h4>{{ $user->id }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>ACCOUNT NUMBER</span>
                                    <h4>{{ $user->account_number }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>EMAIL ADDRESS</span>
                                    <h4>{{ $user->email }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>PHONE NUMBER</span>
                                    <h4>{{ $user->phone ?: 'Not set' }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>BALANCE</span>
                                    <h4>₦{{ number_format($user->balance, 2) }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>CREDIT SCORE</span>
                                    <h4>{{ $user->credit_score }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>COUNTRY OF RESIDENCE</span>
                                    <h4>{{ $user->country ?: 'Not set' }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>JOINED SINCE</span>
                                    <h4>{{ $user->created_at->format('d/m/Y') }}</h4>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="user-info">
                                    <span>STATUS</span>
                                    <h4 class="text-capitalize">{{ $user->status }}</h4>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection