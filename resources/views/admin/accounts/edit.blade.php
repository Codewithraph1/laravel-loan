@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Edit Bank Account</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">Bank Accounts</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Account</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.accounts.update', $account) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <select class="form-select" name="bank_name" required>
                                                <option value="">Select Bank</option>
                                                <option value="Access Bank" {{ $account->bank_name == 'Access Bank' ? 'selected' : '' }}>Access Bank</option>
                                                <option value="First Bank of Nigeria" {{ $account->bank_name == 'First Bank of Nigeria' ? 'selected' : '' }}>First Bank of Nigeria</option>
                                                <option value="Guaranty Trust Bank (GTB)" {{ $account->bank_name == 'Guaranty Trust Bank (GTB)' ? 'selected' : '' }}>Guaranty Trust Bank (GTB)</option>
                                                <option value="Zenith Bank" {{ $account->bank_name == 'Zenith Bank' ? 'selected' : '' }}>Zenith Bank</option>
                                                <option value="United Bank for Africa (UBA)" {{ $account->bank_name == 'United Bank for Africa (UBA)' ? 'selected' : '' }}>United Bank for Africa (UBA)</option>
                                                <option value="Other" {{ !in_array($account->bank_name, ['Access Bank', 'First Bank of Nigeria', 'Guaranty Trust Bank (GTB)', 'Zenith Bank', 'United Bank for Africa (UBA)']) ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bank Code</label>
                                            <input type="text" class="form-control" name="bank_code" value="{{ old('bank_code', $account->bank_code) }}" placeholder="e.g., 011 for First Bank">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Name</label>
                                            <input type="text" class="form-control" name="account_name" value="{{ old('account_name', $account->account_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Number</label>
                                            <input type="text" class="form-control" name="account_number" value="{{ old('account_number', $account->account_number) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Payment Instructions</label>
                                            <textarea class="form-control" name="instructions" rows="4" placeholder="Instructions for users making payments">{{ old('instructions', $account->instructions) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            <strong>Currency:</strong> ₦ Naira (NGN) - This account receives Nigerian Naira payments only.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update Bank Account</button>
                                        <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection