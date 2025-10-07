<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Loan;
use App\Models\LoanRepayment;

class LoanHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        
        $loans = Loan::where('user_id', $user->id)
                    ->with(['repayments'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->through(function ($loan) {
                        $loan->status_color = $this->getLoanStatusColor($loan->status);
                        return $loan;
                    });

        return view('user.loan-history', compact('user', 'loans'));
    }

    public function show($id)
    {
        $user = Auth::guard('web')->user();
        
        $loan = Loan::where('user_id', $user->id)
                   ->with(['repayments' => function($query) {
                       $query->orderBy('due_date', 'asc');
                   }])
                   ->findOrFail($id);

        $loan->status_color = $this->getLoanStatusColor($loan->status);
        
        // Add status colors to repayments
        $loan->repayments->each(function ($repayment) {
            $repayment->status_color = $this->getRepaymentStatusColor($repayment->status);
        });

        return view('user.loan-details', compact('user', 'loan'));
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

    // Helper method for repayment status colors
    private function getRepaymentStatusColor($status)
    {
        return match ($status) {
            'paid' => 'success',
            'pending', 'pending_approval' => 'warning',
            'overdue' => 'danger',
            'partial' => 'info',
            default => 'secondary'
        };
    }
}