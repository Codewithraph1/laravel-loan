@extends('layouts.user')
@section('content')

<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-4">
                    <div class="page-title-content">
                        <h3>Loan History</h3>
                        <p class="mb-2">Your loan applications and repayment history</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs">
                        <a href="{{ route('user.dashboard') }}">Home</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="#">Loan History</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Loans</h4>
                        <a href="{{ route('user.loans.create') }}" class="btn btn-primary btn-sm">
                            <i class="ri-add-line me-1"></i>Apply New Loan
                        </a>
                    </div> 
                    <div class="card-body">
                        @if($loans->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Loan ID</th>
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
                                            <td>${{ number_format($loan->loan_amount, 2) }}</td>
                                            <td>{{ Str::limit($loan->purpose, 30) }}</td>
                                            <td>{{ $loan->tenure_months }} months</td>
                                            <td>{{ $loan->application_date->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $loan->status_color }}">
                                                    {{ ucfirst(str_replace('_', ' ', $loan->status)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.loans.show', $loan->id) }}" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="ri-eye-line"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $loans->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="ri-inbox-line display-1 text-muted"></i>
                                <h4 class="mt-3">No loan applications yet</h4>
                                <p class="text-muted">You haven't applied for any loans yet.</p>
                                <a href="{{ route('user.loans.create') }}" class="btn btn-primary mt-3">
                                    <i class="ri-bank-card-line me-2"></i>Apply for Your First Loan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection