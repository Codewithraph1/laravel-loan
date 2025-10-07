@extends('layouts.user')
@section('content')

<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <div class="page-title-content">
                        <h3>Make Loan Payment</h3>
                        <p class="mb-2">Submit your loan repayment</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs">
                        <a href="{{ route('user.dashboard') }}">Home</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="{{ route('user.loans.index') }}">My Loans</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="#">Make Payment</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Flash Messages Here -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ri-check-line me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ri-error-warning-line me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Display Validation Errors -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ri-error-warning-line me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Details</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.payments.store', $loan->id) }}" enctype="multipart/form-data" id="paymentForm">
                            @csrf


                            <!-- Loan Information -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Loan Information</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Loan Amount</label>
                                        <input type="text" class="form-control" value="₦{{ number_format($loan->loan_amount, 2) }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Monthly Repayment</label>
                                        <input type="text" class="form-control" value="₦{{ number_format($loan->monthly_repayment, 2) }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Select Installment -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Select Installment</h5>
                                </div>
                                <div class="col-12">
                                    @if($pendingRepayments->count() === 0 && $overdueRepayments->count() === 0)
                                    <div class="alert alert-warning">
                                        <i class="ri-alert-line me-2"></i>
                                        No installments available for payment.
                                        @if($loan->status === 'approved')
                                        Your loan has been approved but repayment schedule is being generated.
                                        @else
                                        Please contact support if you believe this is an error.
                                        @endif
                                    </div>
                                    @else
                                    <div class="mb-3">
                                        <label class="form-label">Installment to Pay *</label>
                                        <select class="form-control @error('repayment_id') is-invalid @enderror" name="repayment_id" required>
                                            <option value="">Select Installment</option>
                                            @foreach($pendingRepayments as $repayment)
                                            <option value="{{ $repayment->id }}">
                                                Installment #{{ $repayment->installment_number }} -
                                                Due: {{ $repayment->due_date->format('M d, Y') }} -
                                                Amount: ₦{{ number_format($repayment->amount_due, 2) }}
                                            </option>
                                            @endforeach
                                            @foreach($overdueRepayments as $repayment)
                                            <option value="{{ $repayment->id }}">
                                                ⚠️ OVERDUE - Installment #{{ $repayment->installment_number }} -
                                                Due: {{ $repayment->due_date->format('M d, Y') }} -
                                                Amount: ₦{{ number_format($repayment->amount_due, 2) }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('repayment_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Payment Details -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Payment Information</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Amount Paid (₦) *</label>
                                        <input type="number" step="0.01" class="form-control @error('amount_paid') is-invalid @enderror"
                                            name="amount_paid" placeholder="Enter amount paid" required>
                                        @error('amount_paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payment Method *</label>
                                        <select class="form-control @error('payment_method') is-invalid @enderror" name="payment_method" required>
                                            <option value="">Select Method</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="ussd">USSD</option>
                                            <option value="card">Card Payment</option>
                                            <option value="cash">Cash Deposit</option>
                                        </select>
                                        @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Transaction Reference *</label>
                                        <input type="text" class="form-control @error('transaction_reference') is-invalid @enderror"
                                            name="transaction_reference" placeholder="Enter transaction reference" required>
                                        @error('transaction_reference')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payment Date *</label>
                                        <input type="date" class="form-control @error('payment_date') is-invalid @enderror"
                                            name="payment_date" required>
                                        @error('payment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Account Selection -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Select Bank Account</h5>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Bank Account to Pay Into *</label>
                                        <select class="form-control @error('admin_account_id') is-invalid @enderror" name="admin_account_id" required>
                                            <option value="">Select Bank Account</option>
                                            @foreach($adminAccounts as $account)
                                            <option value="{{ $account->id }}">
                                                {{ $account->bank_name }} - {{ $account->account_name }} - {{ $account->account_number }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('admin_account_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Receipt Upload -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Upload Proof of Payment</h5>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Receipt *</label>
                                        <input type="file" class="form-control @error('receipt') is-invalid @enderror"
                                            name="receipt" accept=".jpg,.jpeg,.png,.pdf" required>
                                        @error('receipt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Upload clear image/scan of your payment receipt (JPG, PNG, PDF, max 2MB)
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                                    <a href="{{ route('user.loans.show', $loan->id) }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar with Bank Account Details -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bank Account Details</h4>
                    </div>
                    <div class="card-body">
                        @foreach($adminAccounts as $account)
                        <div class="bank-account-info mb-4 p-3 border rounded">
                            <h6 class="text-primary">{{ $account->bank_name }}</h6>
                            <div class="mb-2">
                                <strong>Account Name:</strong> {{ $account->account_name }}
                            </div>
                            <div class="mb-2">
                                <strong>Account Number:</strong> {{ $account->account_number }}
                            </div>
                            @if($account->bank_code)
                            <div class="mb-2">
                                <strong>Bank Code:</strong> {{ $account->bank_code }}
                            </div>
                            @endif
                            @if($account->instructions)
                            <div class="mt-2">
                                <small class="text-muted">{{ $account->instructions }}</small>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Instructions -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Instructions</h4>
                    </div>
                    <div class="card-body">
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item border-0 px-0">Select the installment you want to pay</li>
                            <li class="list-group-item border-0 px-0">Choose your payment method</li>
                            <li class="list-group-item border-0 px-0">Transfer to any of our bank accounts</li>
                            <li class="list-group-item border-0 px-0">Enter the exact amount paid</li>
                            <li class="list-group-item border-0 px-0">Upload your payment receipt</li>
                            <li class="list-group-item border-0 px-0">Submit for verification</li>
                        </ol>
                        <div class="alert alert-info mt-3">
                            <strong>Note:</strong> Payments may take 24-48 hours to be verified and reflected in your account.
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection