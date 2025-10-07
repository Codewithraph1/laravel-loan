<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Loan;
use App\Models\LoanRepayment;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login');
        }

        $user = Auth::guard('web')->user();

        // Check if user exists
        if (!$user) {
            Auth::guard('web')->logout();
            return redirect()->route('login');
        }

        // Initialize default values
        $loanStats = [
            'total_loans' => 0,
            'active_loans' => 0,
            'pending_loans' => 0,
            'completed_loans' => 0,
        ];

        $upcomingRepayments = collect();
        $recentLoans = collect();

        try {
            // Get loan statistics
            $loanStats = [
                'total_loans' => Loan::where('user_id', $user->id)->count(),
                'active_loans' => Loan::where('user_id', $user->id)
                    ->whereIn('status', ['active', 'disbursed'])
                    ->count(),
                'pending_loans' => Loan::where('user_id', $user->id)
                    ->whereIn('status', ['pending', 'under_review'])
                    ->count(),
                'completed_loans' => Loan::where('user_id', $user->id)
                    ->where('status', 'completed')
                    ->count(),
            ];

            // Get upcoming repayments
            $upcomingRepayments = LoanRepayment::whereHas('loan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->whereIn('status', ['pending', 'overdue'])
                ->where('due_date', '>=', now())
                ->orderBy('due_date', 'asc')
                ->limit(5)
                ->get();

            // Get recent loans with status colors
            $recentLoans = Loan::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($loan) {
                    $loan->status_color = $this->getLoanStatusColor($loan->status);
                    return $loan;
                });

        } catch (\Exception $e) {
            // Log error but don't break the page
            \Log::error('Dashboard error: ' . $e->getMessage());
        }

        return view('user.dashboard', compact(
            'user',
            'loanStats',
            'upcomingRepayments',
            'recentLoans'
        ));
    }

    // Helper method for loan status colors
    private function getLoanStatusColor($status)
    {
        return match ($status) {
            'approved', 'disbursed', 'active', 'completed' => 'success',
            'pending', 'under_review' => 'warning',
            'rejected', 'defaulted' => 'danger',
            default => 'secondary'
        };
    }
}