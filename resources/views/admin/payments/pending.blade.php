@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Pending Payments</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pending Payments</li>
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
                                            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-primary">
                                                <em class="icon ni ni-list-check"></em>
                                                <span>All Payments</span>
                                            </a>
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
                            @if($payments->count() > 0)
                                <table class="datatable-init table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Payment ID</th>
                                            <th>Customer</th>
                                            <th>Loan ID</th>
                                            <th>Installment</th>
                                            <th>Amount Paid</th>
                                            <th>Due Amount</th>
                                            <th>Payment Date</th>
                                            <th>Method</th>
                                            <th>Reference</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>#{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ $payment->loan->user->fullname }}</span>
                                                    <span class="sub-text">{{ $payment->loan->user->email }}</span>
                                                </div>
                                            </td>
                                            <td>#{{ str_pad($payment->loan_id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>#{{ $payment->installment_number }}</td>
                                            <td class="text-success fw-bold">₦{{ number_format($payment->amount_paid, 2) }}</td>
                                            <td>₦{{ number_format($payment->amount_due, 2) }}</td>
                                            <td>{{ $payment->paid_date ? $payment->paid_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <span class="badge text-bg-primary-soft text-capitalize">
                                                    {{ str_replace('_', ' ', $payment->payment_method) }}
                                                </span>
                                            </td>
                                            <td>
                                                <code>{{ $payment->transaction_reference }}</code>
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
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewPaymentModal{{ $payment->id }}">
                                                                        <em class="icon ni ni-eye"></em>
                                                                        <span>View Details</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#approvePaymentModal{{ $payment->id }}">
                                                                        <em class="icon ni ni-check"></em>
                                                                        <span>Approve</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#rejectPaymentModal{{ $payment->id }}">
                                                                        <em class="icon ni ni-cross"></em>
                                                                        <span>Reject</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- View Payment Modal -->
                                                <div class="modal fade" id="viewPaymentModal{{ $payment->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Payment Details</h5>
                                                                <a href="#" class="close" data-bs-dismiss="modal">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Customer</span>
                                                                        <span class="lead-text">{{ $payment->loan->user->fullname }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Email</span>
                                                                        <span class="lead-text">{{ $payment->loan->user->email }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Loan Amount</span>
                                                                        <span class="lead-text">₦{{ number_format($payment->loan->loan_amount, 2) }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Installment</span>
                                                                        <span class="lead-text">#{{ $payment->installment_number }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Amount Due</span>
                                                                        <span class="lead-text">₦{{ number_format($payment->amount_due, 2) }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Amount Paid</span>
                                                                        <span class="lead-text text-success">₦{{ number_format($payment->amount_paid, 2) }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Payment Method</span>
                                                                        <span class="lead-text text-capitalize">{{ str_replace('_', ' ', $payment->payment_method) }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Reference</span>
                                                                        <span class="lead-text">{{ $payment->transaction_reference }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Payment Date</span>
                                                                        <span class="lead-text">{{ $payment->paid_date ? $payment->paid_date->format('M d, Y') : 'N/A' }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Bank Account</span>
                                                                        <span class="lead-text">{{ $payment->adminAccount->bank_name ?? 'N/A' }}</span>
                                                                    </div>
                                                                    @if($payment->receipt_path)
                                                                    <div class="col-12">
                                                                        <span class="sub-text">Receipt</span>
                                                                        <div class="mt-2">
                                                                            <a href="{{ Storage::url($payment->receipt_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                                                <em class="icon ni ni-download"></em>
                                                                                View Receipt
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Approve Payment Modal -->
                                                <div class="modal fade" id="approvePaymentModal{{ $payment->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Approve Payment</h5>
                                                                <a href="#" class="close" data-bs-dismiss="modal">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to approve this payment?</p>
                                                                    <div class="alert alert-info">
                                                                        <strong>Payment Details:</strong><br>
                                                                        Customer: {{ $payment->loan->user->fullname }}<br>
                                                                        Amount: ₦{{ number_format($payment->amount_paid, 2) }}<br>
                                                                        Installment: #{{ $payment->installment_number }}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label">Admin Notes (Optional)</label>
                                                                        <textarea class="form-control" name="admin_notes" rows="3" placeholder="Add any notes about this approval...">{{ $payment->admin_notes }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success">Approve Payment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Reject Payment Modal -->
                                                <div class="modal fade" id="rejectPaymentModal{{ $payment->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reject Payment</h5>
                                                                <a href="#" class="close" data-bs-dismiss="modal">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </a>
                                                            </div>
                                                            <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Rejection Reason *</label>
                                                                        <textarea class="form-control" name="rejection_reason" rows="3" placeholder="Please provide the reason for rejection..." required>{{ $payment->rejection_reason }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label">Admin Notes (Optional)</label>
                                                                        <textarea class="form-control" name="admin_notes" rows="2" placeholder="Additional notes...">{{ $payment->admin_notes }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Reject Payment</button>
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
                                {{ $payments->links() }}
                            @else
                                <div class="text-center py-4">
                                    <div class="nk-block-content">
                                        <div class="nk-block-content-head">
                                            <h5>No Pending Payments</h5>
                                            <p class="text-muted">There are no payments waiting for approval at the moment.</p>
                                        </div>
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

@endsection