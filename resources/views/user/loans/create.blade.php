@extends('layouts.user')
@section('content')

<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-4">
                    <div class="page-title-content">
                        <h3>Apply for Loan</h3>
                        <p class="mb-2">Complete the form below to apply for a loan</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs">
                        <a href="{{ route('user.dashboard') }}">Home</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="#">Apply Loan</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Loan Application Form</h4>
                        <div class="btn-group">
                            <button type="submit" form="loanForm" class="btn btn-primary">Submit Application</button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="loanForm" method="POST" action="{{ route('user.loans.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Loan Details Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Loan Details</h5>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Loan Amount (₦)</label>
                                        <input type="number" class="form-control @error('loan_amount') is-invalid @enderror" 
                                               name="loan_amount" placeholder="Enter amount" 
                                               value="{{ old('loan_amount') }}" required>
                                        @error('loan_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Loan Tenure (Months)</label>
                                        <input type="number" class="form-control @error('tenure_months') is-invalid @enderror" 
                                               name="tenure_months" placeholder="e.g., 6, 12, 24 months" 
                                               value="{{ old('tenure_months') }}" required>
                                        @error('tenure_months')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Enter loan duration in months (e.g., 3, 6, 12, 24)</small>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Loan Purpose</label>
                                        <input type="text" class="form-control @error('purpose') is-invalid @enderror" 
                                               name="purpose" placeholder="e.g., Business Expansion, Education" 
                                               value="{{ old('purpose') }}" required>
                                        @error('purpose')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Personal Information Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Address Information</h5>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-label">House Address</label>
                                        <textarea class="form-control @error('house_address') is-invalid @enderror" 
                                                  name="house_address" rows="3" placeholder="Enter your complete house address" 
                                                  required>{{ old('house_address') }}</textarea>
                                        @error('house_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                               name="city" placeholder="e.g., Lagos" 
                                               value="{{ old('city') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                               name="state" placeholder="e.g., Lagos State" 
                                               value="{{ old('state') }}" required>
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Next of Kin Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Next of Kin Information</h5>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('next_of_kin_fullname') is-invalid @enderror" 
                                               name="next_of_kin_fullname" placeholder="Next of kin full name" 
                                               value="{{ old('next_of_kin_fullname') }}" required>
                                        @error('next_of_kin_fullname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Relationship</label>
                                        <input type="text" class="form-control @error('next_of_kin_relationship') is-invalid @enderror" 
                                               name="next_of_kin_relationship" placeholder="e.g., Spouse, Parent, Sibling" 
                                               value="{{ old('next_of_kin_relationship') }}" required>
                                        @error('next_of_kin_relationship')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control @error('next_of_kin_phone') is-invalid @enderror" 
                                               name="next_of_kin_phone" placeholder="Next of kin phone number" 
                                               value="{{ old('next_of_kin_phone') }}" required>
                                        @error('next_of_kin_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control @error('next_of_kin_address') is-invalid @enderror" 
                                                  name="next_of_kin_address" rows="2" placeholder="Next of kin address" 
                                                  required>{{ old('next_of_kin_address') }}</textarea>
                                        @error('next_of_kin_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Bank Details Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Bank Account Details (For Loan Disbursement)</h5>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Bank Name</label>
                                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" 
                                               name="bank_name" placeholder="e.g., Access Bank, First Bank, GTBank" 
                                               value="{{ old('bank_name') }}" required>
                                        @error('bank_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Account Number</label>
                                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" 
                                               name="account_number" placeholder="10-digit account number" 
                                               value="{{ old('account_number') }}" required>
                                        @error('account_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Account Name</label>
                                        <input type="text" class="form-control @error('account_name') is-invalid @enderror" 
                                               name="account_name" placeholder="Account holder name" 
                                               value="{{ old('account_name') }}" required>
                                        @error('account_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Identification Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Valid Identification</h5>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">ID Type</label>
                                        <input type="text" class="form-control @error('valid_id_type') is-invalid @enderror" 
                                               name="valid_id_type" placeholder="e.g., NIN, Driver's License, International Passport" 
                                               value="{{ old('valid_id_type') }}" required>
                                        @error('valid_id_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">ID Number</label>
                                        <input type="text" class="form-control @error('valid_id_number') is-invalid @enderror" 
                                               name="valid_id_number" placeholder="ID number" 
                                               value="{{ old('valid_id_number') }}" required>
                                        @error('valid_id_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label class="form-label">Upload ID Document</label>
                                        <input type="file" class="form-control @error('valid_id_path') is-invalid @enderror" 
                                               name="valid_id_path" accept=".jpg,.jpeg,.png,.pdf" required>
                                        @error('valid_id_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Upload clear image/scan of your ID (JPG, PNG, PDF, max 2MB)</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror" 
                                               type="checkbox" name="terms" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" target="_blank">Terms and Conditions</a> and 
                                            confirm that all information provided is accurate
                                        </label>
                                        @error('terms')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-primary">Submit Application</button>
                                        <button type="reset" class="btn btn-outline-primary">Reset Form</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection