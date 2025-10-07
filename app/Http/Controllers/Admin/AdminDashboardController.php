<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Loan;
use App\Models\LoanRepayment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Check if admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $admin = Auth::guard('admin')->user();

        // Get dashboard statistics
        $stats = [
            'total_users' => User::count(),
            'total_loans' => Loan::count(),
            'pending_loans' => Loan::where('status', 'pending')->count(),
            'active_loans' => Loan::whereIn('status', ['active', 'disbursed'])->count(),
            'completed_loans' => Loan::where('status', 'completed')->count(),
            'total_revenue' => LoanRepayment::where('status', 'paid')->sum('amount_paid'),
            'pending_repayments' => LoanRepayment::where('status', 'pending')->count(),
            'overdue_repayments' => LoanRepayment::where('status', 'overdue')->count(),
        ];

        // Get recent loans
        $recentLoans = Loan::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get recent users
        $recentUsers = User::orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact('admin', 'stats', 'recentLoans', 'recentUsers'));
    }
}