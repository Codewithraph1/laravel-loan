@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Nigerian Bank Accounts</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bank Accounts</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">
                                <em class="icon ni ni-plus"></em>
                                <span>Add Account</span>
                            </a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="nk-block">
                    <div class="card">
                        <div class="card-body">
                            <table class="datatable-init table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Bank Code</th>
                                        <th>Currency</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $account)
                                    <tr>
                                        <td>{{ $account->bank_name }}</td>
                                        <td>{{ $account->account_name }}</td>
                                        <td>{{ $account->account_number }}</td>
                                        <td>{{ $account->bank_code ?: 'N/A' }}</td>
                                        <td>₦ NGN</td>
                                        <td>
                                            <span class="badge text-bg-{{ $account->is_active ? 'success' : 'danger' }}-soft">
                                                {{ $account->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $account->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm btn-icon btn-zoom me-n1" data-bs-toggle="dropdown">
                                                    <em class="icon ni ni-more-v"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                    <div class="dropdown-content py-1">
                                                        <ul class="link-list link-list-hover-bg-primary link-list-md">
                                                            <li>
                                                                <a href="{{ route('admin.accounts.edit', $account) }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="event.preventDefault(); document.getElementById('toggle-form-{{ $account->id }}').submit();">
                                                                    <em class="icon ni ni-{{ $account->is_active ? 'cross' : 'check' }}"></em>
                                                                    <span>{{ $account->is_active ? 'Deactivate' : 'Activate' }}</span>
                                                                </a>
                                                                <form id="toggle-form-{{ $account->id }}" action="{{ route('admin.accounts.toggle-status', $account) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('PUT')
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this account?')) { document.getElementById('delete-form-{{ $account->id }}').submit(); }">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>Delete</span>
                                                                </a>
                                                                <form id="delete-form-{{ $account->id }}" action="{{ route('admin.accounts.destroy', $account) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </li>
                                                        </ul>
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