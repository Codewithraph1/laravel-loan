@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Loan Application Details</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.loans.index') }}">Loans</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Loan #{{ str_pad($loan->id, 6, '0', STR_PAD_LEFT) }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-light">
                                <em class="icon ni ni-arrow-left"></em>
                                <span>Back to Loans</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row g-3">
                        <!-- Left Column - Loan Details -->
                        <div class="col-lg-8">
                            <!-- Loan Information Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Loan Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <span class="sub-text">Loan Amount</span>
                                            <span class="lead-text">₦{{ number_format($loan->loan_amount, 2) }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="sub-text">Total Amount</span>
                                            <span class="lead-text">₦{{ number_format($loan->total_amount, 2) }}</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="sub-text">Interest Rate</span>
                                            <span class="lead-text">{{ $loan->interest_rate }}%</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="sub-text">Tenure</span>
                                            <span class="lead-text">{{ $loan->tenure_months }} months</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="sub-text">Monthly Payment</span>
                                            <span class="lead-text">₦{{ number_format($loan->monthly_repayment, 2) }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="sub-text">Loan Purpose</span>
                                            <p class="lead-text">{{ $loan->purpose }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Information Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Customer Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <span class="sub-text">Full Name</span>
                                            <span class="lead-text">{{ $loan->user->fullname }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="sub-text">Email</span>
                                            <span class="lead-text">{{ $loan->user->email }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="sub-text">Phone</span>
                                            <span class="lead-text">{{ $loan->user->phone ?? 'N/A' }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="sub-text">Credit Score</span>
                                            <span class="lead-text">{{ $loan->user->credit_score }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Repayment Schedule -->
                            @if($loan->repayments->count() > 0)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Repayment Schedule</h5>
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
                                                            <span class="badge text-bg-success-soft">Paid</span>
                                                        @elseif($repayment->status == 'overdue')
                                                            <span class="badge text-bg-danger-soft">Overdue</span>
                                                        @elseif($repayment->status == 'partial')
                                                            <span class="badge text-bg-warning-soft">Partial</span>
                                                        @else
                                                            <span class="badge text-bg-secondary-soft">Pending</span>
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

                        <!-- Right Column - Status & Actions -->
                        <div class="col-lg-4">
                            <!-- Status Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Application Status</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        @if($loan->status == 'approved')
                                            <span class="badge text-bg-success-soft fs-6 px-3 py-2">Approved</span>
                                        @elseif($loan->status == 'pending')
                                            <span class="badge text-bg-warning-soft fs-6 px-3 py-2">Pending</span>
                                        @elseif($loan->status == 'rejected')
                                            <span class="badge text-bg-danger-soft fs-6 px-3 py-2">Rejected</span>
                                        @elseif($loan->status == 'disbursed')
                                            <span class="badge text-bg-primary-soft fs-6 px-3 py-2">Disbursed</span>
                                        @else
                                            <span class="badge text-bg-secondary-soft fs-6 px-3 py-2">{{ ucfirst($loan->status) }}</span>
                                        @endif
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Applied Date</span>
                                            <span>{{ $loan->application_date->format('M d, Y') }}</span>
                                        </li>
                                        @if($loan->approval_date)
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Approval Date</span>
                                            <span>{{ $loan->approval_date->format('M d, Y') }}</span>
                                        </li>
                                        @endif
                                        @if($loan->disbursement_date)
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Disbursement Date</span>
                                            <span>{{ $loan->disbursement_date->format('M d, Y') }}</span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            <!-- Financial Summary -->
                            @if(in_array($loan->status, ['active', 'disbursed', 'completed']))
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Financial Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total Paid</span>
                                            <span class="text-success">₦{{ number_format($totalPaid, 2) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Remaining Balance</span>
                                            <span class="text-primary">₦{{ number_format($remainingBalance, 2) }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        @if($loan->status == 'pending' || $loan->status == 'under_review')
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveLoanModal">
                                                <em class="icon ni ni-check"></em>
                                                Approve Loan
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectLoanModal">
                                                <em class="icon ni ni-cross"></em>
                                                Reject Loan
                                            </button>
                                        @endif
                                        @if($loan->status == 'approved')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disburseLoanModal">
                                                <em class="icon ni ni-send"></em>
                                                Mark as Disbursed
                                            </button>
                                        @endif
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editLoanModal">
                                            <em class="icon ni ni-edit"></em>
                                            Edit Loan Details
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Admin Notes -->
                            @if($loan->admin_notes)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Admin Notes</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">{{ $loan->admin_notes }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- Rejection Reason -->
                            @if($loan->rejection_reason)
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="card-title mb-0">Rejection Reason</h5>
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
</div>

<!-- Include the same modals from index page here for the show page -->
<!-- Approve Loan Modal -->
<div class="modal fade" id="approveLoanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Loan Application</h5>
                <a href="#" class="close" data-bs-dismiss="modal">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to approve this loan application?</p>
                    <div class="alert alert-info">
                        <em class="icon ni ni-info"></em>
                        <span>
                            <strong>Loan Details:</strong><br>
                            Amount: ₦{{ number_format($loan->loan_amount, 2) }}<br>
                            Tenure: {{ $loan->tenure_months }} months<br>
                            Interest Rate: {{ $loan->interest_rate }}%
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Admin Notes (Optional)</label>
                        <textarea class="form-control" name="admin_notes" rows="3" placeholder="Add any notes about this approval...">{{ $loan->admin_notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Approve Loan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Loan Modal -->
<div class="modal fade" id="rejectLoanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Loan Application</h5>
                <a href="#" class="close" data-bs-dismiss="modal">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Rejection Reason *</label>
                        <textarea class="form-control" name="rejection_reason" rows="3" placeholder="Please provide the reason for rejection..." required>{{ $loan->rejection_reason }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Admin Notes (Optional)</label>
                        <textarea class="form-control" name="admin_notes" rows="2" placeholder="Additional notes...">{{ $loan->admin_notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Loan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Disburse Loan Modal -->
@if($loan->status == 'approved')
<div class="modal fade" id="disburseLoanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark Loan as Disbursed</h5>
                <a href="#" class="close" data-bs-dismiss="modal">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('admin.loans.disburse', $loan->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Mark this loan as disbursed to the customer's account?</p>
                    <div class="alert alert-info">
                        <em class="icon ni ni-info"></em>
                        <span>
                            <strong>Disbursement Details:</strong><br>
                            Amount: ₦{{ number_format($loan->loan_amount, 2) }}<br>
                            Bank: {{ $loan->bank_name }}<br>
                            Account: {{ $loan->account_number }}<br>
                            Name: {{ $loan->account_name }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Disbursement Notes (Optional)</label>
                        <textarea class="form-control" name="disbursement_notes" rows="2" placeholder="Add disbursement details..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Mark as Disbursed</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Edit Loan Modal -->
<div class="modal fade" id="editLoanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Loan Details</h5>
                <a href="#" class="close" data-bs-dismiss="modal">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('admin.loans.update', $loan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Loan Amount (₦)</label>
                                <input type="number" class="form-control" name="loan_amount" value="{{ $loan->loan_amount }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Interest Rate (%)</label>
                                <input type="number" step="0.01" class="form-control" name="interest_rate" value="{{ $loan->interest_rate }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tenure (Months)</label>
                                <input type="number" class="form-control" name="tenure_months" value="{{ $loan->tenure_months }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Monthly Repayment</label>
                                <input type="text" class="form-control" value="₦{{ number_format($loan->monthly_repayment, 2) }}" readonly>
                                <small class="form-text text-muted">This will be recalculated automatically</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Loan Purpose</label>
                                <input type="text" class="form-control" name="purpose" value="{{ $loan->purpose }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Admin Notes</label>
                                <textarea class="form-control" name="admin_notes" rows="3">{{ $loan->admin_notes }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Loan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection