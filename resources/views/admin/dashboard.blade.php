@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <!-- Welcome Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Welcome, {{ $admin->name ?? 'Admin' }}</h3>
                                <p class="card-text">Here's an overview of your loan management system</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row g-gs">
                    <!-- Total Users -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Total Users</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-primary">
                                        <em class="icon ni ni-users"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">{{ $stats['total_users'] }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>Registered users</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Loans -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Total Loans</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-success">
                                        <em class="icon ni ni-money"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">{{ $stats['total_loans'] }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>All time loans</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Loans -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Pending Loans</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-warning">
                                        <em class="icon ni ni-clock"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">{{ $stats['pending_loans'] }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>Awaiting approval</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Loans -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Active Loans</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-info">
                                        <em class="icon ni ni-activity"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">{{ $stats['active_loans'] }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>Currently active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Total Revenue</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-purple">
                                        <em class="icon ni ni-chart-pie"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">${{ number_format($stats['total_revenue'], 2) }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>From repayments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Loans -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Completed</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-success">
                                        <em class="icon ni ni-check-circle"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">{{ $stats['completed_loans'] }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>Fully repaid</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Repayments -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Pending Repayments</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-warning">
                                        <em class="icon ni ni-clock"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">{{ $stats['pending_repayments'] }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>Awaiting payment</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Overdue Repayments -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title-group align-items-start">
                                    <div class="card-title">
                                        <h6 class="title">Overdue</h6>
                                    </div>
                                    <div class="media media-middle media-circle media-sm text-bg-danger">
                                        <em class="icon ni ni-alert"></em>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="amount h2">{{ $stats['overdue_repayments'] }}</div>
                                    <div class="d-flex align-items-center smaller text-muted">
                                        <span>Late payments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Section -->
                <div class="row g-gs mt-4">
                    <!-- Recent Loans -->
                    <div class="col-lg-8">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title">Recent Loan Applications</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Amount</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentLoans as $loan)
                                            <tr>
                                                <td>
                                                    <div class="media-group">
                                                        <div class="media media-sm media-circle bg-light">
                                                            <span class="title">{{ substr($loan->user->fullname ?? 'N/A', 0, 1) }}</span>
                                                        </div>
                                                        <div class="media-text">
                                                            <span class="title">{{ $loan->user->fullname ?? 'N/A' }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($loan->loan_amount, 2) }}</td>
                                                <td>{{ Str::limit($loan->purpose, 30) }}</td>
                                                <td>
                                                    <span class="badge 
                                                        @if($loan->status == 'approved') bg-success
                                                        @elseif($loan->status == 'pending') bg-warning
                                                        @elseif($loan->status == 'rejected') bg-danger
                                                        @elseif($loan->status == 'active') bg-info
                                                        @else bg-secondary @endif">
                                                        {{ ucfirst($loan->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $loan->created_at->format('M d, Y') }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No recent loans found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title">Recent Users</h5>
                            </div>
                            <div class="card-body">
                                <div class="nk-timeline nk-timeline-center">
                                    @forelse($recentUsers as $user)
                                    <div class="nk-timeline-item mb-3">
                                        <div class="nk-timeline-item-inner">
                                            <div class="nk-timeline-symbol">
                                                <div class="media media-sm media-circle bg-primary">
                                                    <span class="title">{{ substr($user->fullname, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="nk-timeline-content">
                                                <p class="small mb-1"><strong>{{ $user->fullname }}</strong></p>
                                                <p class="small text-muted mb-0">{{ $user->email }}</p>
                                                <p class="small text-muted mb-0">Joined: {{ $user->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="text-center text-muted py-3">
                                        <p>No recent users</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="card-title">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-primary">
                                        <em class="icon ni ni-plus me-1"></em> Add New Loan
                                    </a>
                                    <a href="#" class="btn btn-outline-primary">
                                        <em class="icon ni ni-users me-1"></em> Manage Users
                                    </a>
                                    <a href="#" class="btn btn-outline-info">
                                        <em class="icon ni ni-file-text me-1"></em> View Reports
                                    </a>
                                    <a href="#" class="btn btn-outline-warning">
                                        <em class="icon ni ni-setting me-1"></em> System Settings
                                    </a>
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