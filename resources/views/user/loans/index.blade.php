@extends('layouts.user')
@section('content')
<div class="content-body">
    <div class="container">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <div class="page-title-content">
                        <h3>My Loans</h3>
                        <p class="mb-2">View your loan applications and status</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs">
                        <a href="{{ route('user.dashboard') }}">Home</a>
                        <span><i class="ri-arrow-right-s-line"></i></span>
                        <a href="#">My Loans</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="ri-alert-line me-2"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Loan Applications</h4>
                        <a href="{{ route('user.loans.create') }}" class="btn btn-primary">Apply for New Loan</a>
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
                                            <th>Status</th>
                                            <th>Applied Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loans as $loan)
                                        <tr>
                                            <td>#{{ str_pad($loan->id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>₦{{ number_format($loan->loan_amount, 2) }}</td>
                                            <td>{{ Str::limit($loan->purpose, 30) }}</td>
                                            <td>
                                                @if($loan->status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($loan->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($loan->status == 'under_review')
                                                    <span class="badge bg-info">Under Review</span>
                                                @elseif($loan->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif($loan->status == 'disbursed')
                                                    <span class="badge bg-primary">Disbursed</span>
                                                @elseif($loan->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif($loan->status == 'completed')
                                                    <span class="badge bg-secondary">Completed</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($loan->status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $loan->application_date->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('user.loans.show', $loan->id) }}" class="btn btn-sm btn-primary">View</a>
                                                @if($loan->status == 'pending')
                                                    <form action="{{ route('user.loans.cancel', $loan->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Cancel</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $loans->links() }}
                        @else
                            <div class="text-center py-4">
                                <p class="text-muted">You haven't applied for any loans yet.</p>
                                <a href="{{ route('user.loans.create') }}" class="btn btn-primary">Apply for Your First Loan</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection