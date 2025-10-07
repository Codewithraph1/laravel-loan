@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Add Nigerian Bank Account</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">Bank Accounts</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Account</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.accounts.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <select class="form-select" name="bank_name" required>
                                                <option value="">Select Bank</option>
                                                <option value="Access Bank">Access Bank</option>
                                                <option value="First Bank of Nigeria">First Bank of Nigeria</option>
                                                <option value="Guaranty Trust Bank (GTB)">Guaranty Trust Bank (GTB)</option>
                                                <option value="Zenith Bank">Zenith Bank</option>
                                                <option value="United Bank for Africa (UBA)">United Bank for Africa (UBA)</option>
                                                <option value="Union Bank of Nigeria">Union Bank of Nigeria</option>
                                                <option value="Stanbic IBTC Bank">Stanbic IBTC Bank</option>
                                                <option value="Sterling Bank">Sterling Bank</option>
                                                <option value="Fidelity Bank">Fidelity Bank</option>
                                                <option value="Ecobank Nigeria">Ecobank Nigeria</option>
                                                <option value="Heritage Bank">Heritage Bank</option>
                                                <option value="Polaris Bank">Polaris Bank</option>
                                                <option value="Unity Bank">Unity Bank</option>
                                                <option value="Wema Bank">Wema Bank</option>
                                                <option value="Keystone Bank">Keystone Bank</option>
                                                <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                                <option value="Citibank Nigeria">Citibank Nigeria</option>
                                                <option value="SunTrust Bank">SunTrust Bank</option>
                                                <option value="Providus Bank">Providus Bank</option>
                                                <option value="Jaiz Bank">Jaiz Bank</option>
                                                <option value="Titan Trust Bank">Titan Trust Bank</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bank Code</label>
                                            <input type="text" class="form-control" name="bank_code" value="{{ old('bank_code') }}" placeholder="e.g., 011 for First Bank">
                                            <small class="form-text text-muted">Nigerian bank code (optional)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Name</label>
                                            <input type="text" class="form-control" name="account_name" value="{{ old('account_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Number</label>
                                            <input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Payment Instructions</label>
                                            <textarea class="form-control" name="instructions" rows="4" placeholder="Instructions for users making payments (e.g., include account number as reference)">{{ old('instructions') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            <strong>Currency:</strong> ₦ Naira (NGN) - This account will receive Nigerian Naira payments only.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Add Bank Account</button>
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