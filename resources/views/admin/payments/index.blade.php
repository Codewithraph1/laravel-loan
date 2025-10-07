@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">All Payments</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Payments</li>
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
                                            <a href="{{ route('admin.payments.pending') }}" class="btn btn-outline-primary">
                                                <em class="icon ni ni-alert-fill"></em>
                                                <span>Pending Payments</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            <th>Amount Paid</th>
                                            <th>Payment Date</th>
                                            <th>Method</th>
                                            <th>Status</th>
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
                                            <td class="fw-bold">₦{{ number_format($payment->amount_paid, 2) }}</td>
                                            <td>{{ $payment->paid_date ? $payment->paid_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <span class="badge text-bg-primary-soft text-capitalize">
                                                    {{ str_replace('_', ' ', $payment->payment_method) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($payment->status == 'paid')
                                                    <span class="badge text-bg-success-soft">Approved</span>
                                                @elseif($payment->status == 'partial')
                                                    <span class="badge text-bg-warning-soft">Partial</span>
                                                @elseif($payment->status == 'pending_approval')
                                                    <span class="badge text-bg-warning-soft">Pending</span>
                                                @else
                                                    <span class="badge text-bg-secondary-soft">{{ ucfirst($payment->status) }}</span>
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
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewPaymentModal{{ $payment->id }}">
                                                                        <em class="icon ni ni-eye"></em>
                                                                        <span>View Details</span>
                                                                    </a>
                                                                </li>
                                                                @if($payment->receipt_path)
                                                                <li>
                                                                    <a href="{{ Storage::url($payment->receipt_path) }}" target="_blank">
                                                                        <em class="icon ni ni-download"></em>
                                                                        <span>View Receipt</span>
                                                                    </a>
                                                                </li>
                                                                @endif
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
                                                                        <span class="sub-text">Amount Paid</span>
                                                                        <span class="lead-text text-success">₦{{ number_format($payment->amount_paid, 2) }}</span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <span class="sub-text">Payment Status</span>
                                                                        <span class="lead-text">
                                                                            @if($payment->status == 'paid')
                                                                                <span class="badge text-bg-success-soft">Approved</span>
                                                                            @elseif($payment->status == 'partial')
                                                                                <span class="badge text-bg-warning-soft">Partial</span>
                                                                            @elseif($payment->status == 'pending_approval')
                                                                                <span class="badge text-bg-warning-soft">Pending</span>
                                                                            @else
                                                                                <span class="badge text-bg-secondary-soft">{{ ucfirst($payment->status) }}</span>
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    @if($payment->admin_notes)
                                                                    <div class="col-12">
                                                                        <span class="sub-text">Admin Notes</span>
                                                                        <p class="lead-text">{{ $payment->admin_notes }}</p>
                                                                    </div>
                                                                    @endif
                                                                    @if($payment->rejection_reason)
                                                                    <div class="col-12">
                                                                        <span class="sub-text text-danger">Rejection Reason</span>
                                                                        <p class="lead-text text-danger">{{ $payment->rejection_reason }}</p>
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
                                            <h5>No Payments Found</h5>
                                            <p class="text-muted">There are no payments in the system yet.</p>
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