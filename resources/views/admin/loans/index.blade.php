@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Loan Applications</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Loans</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                    <em class="icon ni ni-more-v"></em>
                                </a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-outline-light btn-dim" data-bs-toggle="dropdown">
                                                    <em class="icon ni ni-filter-alt"></em>
                                                    <span>Filter by Status</span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{ route('admin.loans.index') }}"><span>All Loans</span></a></li>
                                                        <li><a href="{{ route('admin.loans.by-status', 'pending') }}"><span>Pending</span></a></li>
                                                        <li><a href="{{ route('admin.loans.by-status', 'under_review') }}"><span>Under Review</span></a></li>
                                                        <li><a href="{{ route('admin.loans.by-status', 'approved') }}"><span>Approved</span></a></li>
                                                        <li><a href="{{ route('admin.loans.by-status', 'rejected') }}"><span>Rejected</span></a></li>
                                                        <li><a href="{{ route('admin.loans.by-status', 'disbursed') }}"><span>Disbursed</span></a></li>
                                                        <li><a href="{{ route('admin.loans.by-status', 'active') }}"><span>Active</span></a></li>
                                                        <li><a href="{{ route('admin.loans.by-status', 'completed') }}"><span>Completed</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="nk-block">
                    <div class="card">
                        <div class="card-body">
                            <table class="datatable-init table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Loan ID</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Purpose</th>
                                        <th>Tenure</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loans as $loan)
                                    <tr>
                                        <td>#{{ str_pad($loan->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <div class="user-info">
                                                <span class="lead-text">{{ $loan->user->fullname }}</span>
                                                <span class="sub-text">{{ $loan->user->email }}</span>
                                            </div>
                                        </td>
                                        <td>₦{{ number_format($loan->loan_amount, 2) }}</td>
                                        <td>{{ Str::limit($loan->purpose, 30) }}</td>
                                        <td>{{ $loan->tenure_months }} months</td>
                                        <td>{{ $loan->application_date->format('M d, Y') }}</td>
                                        <td>
                                            @if($loan->status == 'approved')
                                                <span class="badge text-bg-success-soft">Approved</span>
                                            @elseif($loan->status == 'pending')
                                                <span class="badge text-bg-warning-soft">Pending</span>
                                            @elseif($loan->status == 'under_review')
                                                <span class="badge text-bg-info-soft">Under Review</span>
                                            @elseif($loan->status == 'rejected')
                                                <span class="badge text-bg-danger-soft">Rejected</span>
                                            @elseif($loan->status == 'disbursed')
                                                <span class="badge text-bg-primary-soft">Disbursed</span>
                                            @elseif($loan->status == 'active')
                                                <span class="badge text-bg-success-soft">Active</span>
                                            @elseif($loan->status == 'completed')
                                                <span class="badge text-bg-secondary-soft">Completed</span>
                                            @else
                                                <span class="badge text-bg-secondary-soft">{{ ucfirst($loan->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm btn-icon btn-zoom me-n1" data-bs-toggle="dropdown">
                                                    <em class="icon ni ni-more-v"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                    <div class="dropdown-content py-1">
                                                        <ul class="link-list link-list-hover-bg-primary link-list-md">
                                                            <li>
                                                                <a href="{{ route('admin.loans.show', $loan->id) }}">
                                                                    <em class="icon ni ni-eye"></em>
                                                                    <span>View Details</span>
                                                                </a>
                                                            </li>
                                                            @if($loan->status == 'pending' || $loan->status == 'under_review')
                                                            <li>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#approveLoanModal{{ $loan->id }}">
                                                                    <em class="icon ni ni-check"></em>
                                                                    <span>Approve</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#rejectLoanModal{{ $loan->id }}">
                                                                    <em class="icon ni ni-cross"></em>
                                                                    <span>Reject</span>
                                                                </a>
                                                            </li>
                                                            @endif
                                                            @if($loan->status == 'approved')
                                                            <li>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#disburseLoanModal{{ $loan->id }}">
                                                                    <em class="icon ni ni-send"></em>
                                                                    <span>Mark as Disbursed</span>
                                                                </a>
                                                            </li>
                                                            @endif
                                                            <li>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editLoanModal{{ $loan->id }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Approve Loan Modal -->
                                            <div class="modal fade" id="approveLoanModal{{ $loan->id }}" tabindex="-1">
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
                                                                <div class="form-group">
                                                                    <label class="form-label">Admin Notes (Optional)</label>
                                                                    <textarea class="form-control" name="admin_notes" rows="3" placeholder="Add any notes about this approval..."></textarea>
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
                                            <div class="modal fade" id="rejectLoanModal{{ $loan->id }}" tabindex="-1">
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
                                                                    <textarea class="form-control" name="rejection_reason" rows="3" placeholder="Please provide the reason for rejection..." required></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Admin Notes (Optional)</label>
                                                                    <textarea class="form-control" name="admin_notes" rows="2" placeholder="Additional notes..."></textarea>
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
                                            <div class="modal fade" id="disburseLoanModal{{ $loan->id }}" tabindex="-1">
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
                                                                    <span>Bank: {{ $loan->bank_name }}<br>
                                                                    Account: {{ $loan->account_number }}<br>
                                                                    Name: {{ $loan->account_name }}</span>
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
                                            <div class="modal fade" id="editLoanModal{{ $loan->id }}" tabindex="-1">
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
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection