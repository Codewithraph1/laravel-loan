@extends('layouts.user')
@section('content')

<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-4">
                    <div class="page-title-content">
                        <h3>Dashboard</h3>
                        <p class="mb-2">Welcome {{ $user->fullname ?? 'User' }}</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs">
                        <a href="#">Home</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="#">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Statistics -->
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget d-flex align-items-center">
                            <div class="widget-icon me-3 bg-primary">
                                <span><i class="ri-bank-card-line"></i></span>
                            </div>
                            <div class="widget-content">
                                <h3>{{ $loanStats['total_loans'] ?? 0 }}</h3>
                                <p>Total Loans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget d-flex align-items-center">
                            <div class="widget-icon me-3 bg-success">
                                <span><i class="ri-progress-3-line"></i></span>
                            </div>
                            <div class="widget-content">
                                <h3>{{ $loanStats['active_loans'] ?? 0 }}</h3>
                                <p>Active Loans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget d-flex align-items-center">
                            <div class="widget-icon me-3 bg-warning">
                                <span><i class="ri-time-line"></i></span>
                            </div>
                            <div class="widget-content">
                                <h3>{{ $loanStats['pending_loans'] ?? 0 }}</h3>
                                <p>Pending Loans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget d-flex align-items-center">
                            <div class="widget-icon me-3 bg-info">
                                <span><i class="ri-check-double-line"></i></span>
                            </div>
                            <div class="widget-content">
                                <h3>{{ $loanStats['completed_loans'] ?? 0 }}</h3>
                                <p>Completed Loans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Upcoming Repayments -->
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Upcoming Repayments</h4>
                    </div>
                    <div class="card-body">
                        @if($upcomingRepayments && $upcomingRepayments->count() > 0)
                            <div class="invoice-content">
                                <ul>
                                    @foreach($upcomingRepayments as $repayment)
                                    @php
                                        $repaymentStatusColor = $repayment->status == 'overdue' ? 'danger' : 'warning';
                                        $iconColor = $repayment->status == 'overdue' ? 'danger' : 'primary';
                                    @endphp
                                    <li class="d-flex justify-content-between 
                                        {{ $repayment->status == 'overdue' ? 'border-danger' : '' }}">
                                        <div class="d-flex align-items-center">
                                            <div class="invoice-user-img me-3 bg-{{ $iconColor }}">
                                                <span><i class="ri-calendar-line text-white"></i></span>
                                            </div>
                                            <div class="invoice-info">
                                                <h5 class="mb-0">Installment #{{ $repayment->installment_number }}</h5>
                                                <p>Due: {{ $repayment->due_date->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="mb-2">${{ number_format($repayment->amount_due, 2) }}</h5>
                                            <span class="badge bg-{{ $repaymentStatusColor }}">
                                                {{ ucfirst($repayment->status) }}
                                            </span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-muted text-center">No upcoming repayments</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Loans -->
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Loans</h4>
                    </div>
                    <div class="card-body">
                        @if($recentLoans && $recentLoans->count() > 0)
                            <div class="invoice-content">
                                <ul>
                                    @foreach($recentLoans as $loan)
                                    <li class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="invoice-user-img me-3 bg-{{ $loan->status_color ?? 'secondary' }}">
                                                <span><i class="ri-bank-card-line text-white"></i></span>
                                            </div>
                                            <div class="invoice-info">
                                                <h5 class="mb-0">${{ number_format($loan->loan_amount, 2) }}</h5>
                                                <p>{{ Str::limit($loan->purpose, 30) }}</p>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="mb-2">{{ $loan->tenure_months }} months</h5>
                                            <span class="badge bg-{{ $loan->status_color ?? 'secondary' }}">
                                                {{ ucfirst(str_replace('_', ' ', $loan->status)) }}
                                            </span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-muted text-center">No loan applications yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple User Info -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Account Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <strong>Account Balance:</strong>
                                    <span>${{ number_format($user->balance ?? 0, 2) }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <strong>Credit Score:</strong>
                                    <span>{{ $user->credit_score ?? 0 }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <strong>Account Status:</strong>
                                    <span class="text-capitalize">{{ $user->status ?? 'active' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <strong>Account Number:</strong>
                                    <span>{{ $user->account_number ?? 'Not set' }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <strong>Email:</strong>
                                    <span>{{ $user->email ?? '' }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <strong>Member Since:</strong>
                                    <span>{{ ($user->created_at ?? now())->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('user.loans.create') }}" class="btn btn-primary w-100">
                                    <i class="ri-bank-card-line me-2"></i>Apply for Loan
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('user.loan-history') }}" class="btn btn-outline-primary w-100">
                                    <i class="ri-history-line me-2"></i>Loan History
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary w-100">
                                    <i class="ri-user-line me-2"></i>Profile
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('user.loans.index') }}" class="btn btn-outline-info w-100">
                                    <i class="ri-money-dollar-circle-line me-2"></i>Make Payment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection