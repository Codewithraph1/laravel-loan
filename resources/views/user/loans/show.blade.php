@extends('layouts.user')
@section('content')

<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <div class="page-title-content">
                        <h3>Loan Application Details</h3>
                        <p class="mb-2">View your loan application status and details</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs">
                        <a href="{{ route('user.dashboard') }}">Home</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('user.loans.index') }}">My Loans</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="#">Loan Details</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <!-- Loan Status Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Application Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="loan-status-badge me-3">
                                        @if($loan->status == 'approved')
                                        <span class="badge bg-success fs-6">Approved</span>
                                        @elseif($loan->status == 'pending')
                                        <span class="badge bg-warning fs-6">Pending Review</span>
                                        @elseif($loan->status == 'under_review')
                                        <span class="badge bg-info fs-6">Under Review</span>
                                        @elseif($loan->status == 'rejected')
                                        <span class="badge bg-danger fs-6">Rejected</span>
                                        @elseif($loan->status == 'disbursed')
                                        <span class="badge bg-primary fs-6">Disbursed</span>
                                        @elseif($loan->status == 'active')
                                        <span class="badge bg-success fs-6">Active</span>
                                        @elseif($loan->status == 'completed')
                                        <span class="badge bg-secondary fs-6">Completed</span>
                                        @elseif($loan->status == 'defaulted')
                                        <span class="badge bg-danger fs-6">Defaulted</span>
                                        @else
                                        <span class="badge bg-secondary fs-6">{{ ucfirst($loan->status) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Loan #{{ str_pad($loan->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                        <p class="text-muted mb-0">Applied on {{ $loan->application_date->format('F d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                @if($loan->status == 'approved')
                                <a href="{{ route('user.loans.agreement', $loan->id) }}" class="btn btn-outline-primary me-2">
                                    <i class="ri-download-line"></i> Download Agreement
                                </a>
                                @endif
                                @if($loan->status == 'active' || $loan->status == 'disbursed')
                                <a href="{{ route('user.payments.create', $loan->id) }}" class="btn btn-primary">
                                    <i class="ri-bank-card-line"></i> Make Payment
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <!-- Left Column - Loan Details -->
                    <div class="col-xl-8">
                        <!-- Loan Information Card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="card-title">Loan Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Loan Amount</label>
                                            <div class="fs-5 fw-bold text-primary">₦{{ number_format($loan->loan_amount, 2) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Total Amount to Repay</label>
                                            <div class="fs-5 fw-bold">₦{{ number_format($loan->total_amount, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Interest Rate</label>
                                            <div class="fw-semibold">{{ $loan->interest_rate }}%</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Tenure</label>
                                            <div class="fw-semibold">{{ $loan->tenure_months }} Months</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Monthly Repayment</label>
                                            <div class="fw-semibold">₦{{ number_format($loan->monthly_repayment, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Loan Purpose</label>
                                            <div class="fw-semibold">{{ $loan->purpose }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Repayment Schedule Card -->
                        @if($loan->repayments->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="card-title">Repayment Schedule</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Installment</th>
                                                <th>Due Date</th>
                                                <th>Amount Due</th>
                                                <th>Amount Paid</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($loan->repayments as $repayment)
                                            <tr>
                                                <td>#{{ $repayment->installment_number }}</td>
                                                <td>{{ $repayment->due_date->format('M d, Y') }}</td>
                                                <td>₦{{ number_format($repayment->amount_due, 2) }}</td>
                                                <td>
                                                    @if($repayment->amount_paid > 0)
                                                    ₦{{ number_format($repayment->amount_paid, 2) }}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($repayment->status == 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                    @elseif($repayment->status == 'overdue')
                                                    <span class="badge bg-danger">Overdue</span>
                                                    @elseif($repayment->status == 'partial')
                                                    <span class="badge bg-warning">Partial</span>
                                                    @else
                                                    <span class="badge bg-secondary">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Right Column - Additional Information -->
                    <div class="col-xl-4">
                        <!-- Application Summary Card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="card-title">Application Summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Application Date</label>
                                    <div class="fw-semibold">{{ $loan->application_date->format('F d, Y') }}</div>
                                </div>
                                @if($loan->approval_date)
                                <div class="mb-3">
                                    <label class="form-label">Approval Date</label>
                                    <div class="fw-semibold">{{ $loan->approval_date->format('F d, Y') }}</div>
                                </div>
                                @endif
                                @if($loan->disbursement_date)
                                <div class="mb-3">
                                    <label class="form-label">Disbursement Date</label>
                                    <div class="fw-semibold">{{ $loan->disbursement_date->format('F d, Y') }}</div>
                                </div>
                                @endif
                                @if($loan->due_date)
                                <div class="mb-3">
                                    <label class="form-label">Final Due Date</label>
                                    <div class="fw-semibold">{{ $loan->due_date->format('F d, Y') }}</div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Financial Summary Card -->
                        @if(in_array($loan->status, ['active', 'disbursed', 'completed']))
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="card-title">Financial Summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Total Paid</label>
                                    <div class="fw-bold text-success">₦{{ number_format($totalPaid, 2) }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Remaining Balance</label>
                                    <div class="fw-bold text-primary">₦{{ number_format($remainingBalance, 2) }}</div>
                                </div>
                                @if($nextPayment)
                                <div class="mb-3">
                                    <label class="form-label">Next Payment Due</label>
                                    <div class="fw-semibold">{{ $nextPayment->due_date->format('M d, Y') }}</div>
                                    <div class="text-muted small">₦{{ number_format($nextPayment->amount_due, 2) }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Quick Actions Card -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Quick Actions</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    @if($loan->status == 'pending')
                                    <form action="{{ route('user.loans.cancel', $loan->id) }}" method="POST" class="d-grid">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel this loan application?')">
                                            <i class="ri-close-line"></i> Cancel Application
                                        </button>
                                    </form>
                                    @endif

                                    <a href="{{ route('user.loans.index') }}" class="btn btn-outline-primary">
                                        <i class="ri-arrow-left-line"></i> Back to Loans
                                    </a>

                                    @if($loan->status == 'active' || $loan->status == 'disbursed')
                                    <a href="{{ route('user.payments.create', $loan->id) }}" class="btn btn-primary">
                                        <i class="ri-bank-card-line"></i> Make Payment
                                    </a>
                                    @endif

                                    @if($loan->status == 'approved')
                                    <a href="{{ route('user.loans.agreement', $loan->id) }}" class="btn btn-outline-success">
                                        <i class="ri-download-line"></i> Download Agreement
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Admin Notes -->
                        @if($loan->admin_notes)
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Admin Notes</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">{{ $loan->admin_notes }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Rejection Reason -->
                        @if($loan->rejection_reason)
                        <div class="card mt-4 border-danger">
                            <div class="card-header bg-danger text-white">
                                <h4 class="card-title mb-0">Rejection Reason</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-danger">{{ $loan->rejection_reason }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .loan-status-badge .badge {
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }
</style>

@endsection