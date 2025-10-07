@extends('layouts.admin')
@section('content')

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Users List</h2>
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">User Manage</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                                </ol>
                            </nav>
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
                            <table class="datatable-init table" data-nk-container="table-responsive">
                                <thead class="table-light">
                                    <tr>
                                        <th class="tb-col"><span class="overline-title">User</span></th>
                                        <th class="tb-col"><span class="overline-title">Account Number</span></th>
                                        <th class="tb-col"><span class="overline-title">Phone</span></th>
                                        <th class="tb-col"><span class="overline-title">Balance</span></th>
                                        <th class="tb-col"><span class="overline-title">Credit Score</span></th>
                                        <th class="tb-col tb-col-xxl"><span class="overline-title">Joined Date</span></th>
                                        <th class="tb-col"><span class="overline-title">Status</span></th>
                                        <th class="tb-col"><span class="overline-title">Verified</span></th>
                                        <th class="tb-col tb-col-end" data-sortable="false"><span class="overline-title">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="tb-col">
                                            <div class="media-group">
                                                <div class="media media-md media-middle media-circle">
                                                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/avatar/a.jpg') }}" alt="user">
                                                </div>
                                                <div class="media-text">
                                                    <a href="{{ route('admin.users.show', $user) }}" class="title">{{ $user->fullname }}</a>
                                                    <span class="small text">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="tb-col">{{ $user->account_number }}</td>
                                        <td class="tb-col">{{ $user->phone ?: 'N/A' }}</td>
                                        <td class="tb-col">₦{{ number_format($user->balance, 2) }}</td>
                                        <td class="tb-col">{{ $user->credit_score }}</td>
                                        <td class="tb-col tb-col-xxl">{{ $user->created_at->format('Y/m/d') }}</td>
                                        <td class="tb-col">
                                            <span class="badge text-bg-{{ $user->status == 'active' ? 'success' : ($user->status == 'suspended' ? 'warning' : 'danger') }}-soft">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>
                                        <td class="tb-col">
                                            <span class="badge text-bg-{{ $user->is_verified ? 'success' : 'warning' }}-soft">
                                                {{ $user->is_verified ? 'Verified' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="tb-col tb-col-end">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm btn-icon btn-zoom me-n1" data-bs-toggle="dropdown">
                                                    <em class="icon ni ni-more-v"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                    <div class="dropdown-content py-1">
                                                        <ul class="link-list link-list-hover-bg-primary link-list-md">
                                                            <li>
                                                                <a href="{{ route('admin.users.show', $user) }}">
                                                                    <em class="icon ni ni-eye"></em>
                                                                    <span>View Details</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admin.users.edit', $user) }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#statusModal{{ $user->id }}">
                                                                    <em class="icon ni ni-user-check"></em>
                                                                    <span>Change Status</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="event.preventDefault(); document.getElementById('verify-form-{{ $user->id }}').submit();">
                                                                    <em class="icon ni ni-shield-check"></em>
                                                                    <span>{{ $user->is_verified ? 'Unverify' : 'Verify' }}</span>
                                                                </a>
                                                                <form id="verify-form-{{ $user->id }}" action="{{ route('admin.users.toggle-verification', $user) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('PUT')
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#passwordModal{{ $user->id }}">
                                                                    <em class="icon ni ni-key"></em>
                                                                    <span>Change Password</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>Delete</span>
                                                                </a>
                                                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status Change Modal -->
                                            <div class="modal fade" id="statusModal{{ $user->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Change User Status</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('admin.users.update-status', $user) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="form-label">Select Status</label>
                                                                    <select class="form-select" name="status" required>
                                                                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                                                        <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                                                        <option value="closed" {{ $user->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Update Status</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Password Change Modal -->
                                            <div class="modal fade" id="passwordModal{{ $user->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Change Password for {{ $user->fullname }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('admin.users.update-password', $user) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="form-label">New Password</label>
                                                                    <input type="password" class="form-control" name="password" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Confirm Password</label>
                                                                    <input type="password" class="form-control" name="password_confirmation" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Update Password</button>
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

                            <div class="datatable-bottom">
                                <div class="datatable-info">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                                </div>
                                <nav class="datatable-pagination">
                                    {{ $users->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection