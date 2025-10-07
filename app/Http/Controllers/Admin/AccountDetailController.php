<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAccountDetail;
use Illuminate\Http\Request;

class AccountDetailController extends Controller
{
   

    public function index()
    {
        $accounts = AdminAccountDetail::latest()->get();
        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_code' => 'nullable|string|max:10',
            'instructions' => 'nullable|string',
        ]);

        AdminAccountDetail::create([
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'bank_code' => $request->bank_code,
            'currency' => 'NGN',
            'instructions' => $request->instructions,
            'is_active' => true,
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Bank account details added successfully.');
    }

    public function edit(AdminAccountDetail $account)
    {
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, AdminAccountDetail $account)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_code' => 'nullable|string|max:10',
            'instructions' => 'nullable|string',
        ]);

        $account->update([
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'bank_code' => $request->bank_code,
            'instructions' => $request->instructions,
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Bank account details updated successfully.');
    }

    public function destroy(AdminAccountDetail $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Bank account details deleted successfully.');
    }

    public function toggleStatus(AdminAccountDetail $account)
    {
        $account->update(['is_active' => !$account->is_active]);
        $status = $account->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Bank account {$status} successfully.");
    }
}