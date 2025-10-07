<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use App\Models\LoanRepayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLoanController extends Controller
{
    /**
     * Display all loans
     */
    public function index()
    {
        $loans = Loan::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.loans.index', compact('loans'));
    }

    /**
     * Show loan details
     */
    public function show($id)
    {
        $loan = Loan::with(['user', 'repayments'])
            ->findOrFail($id);

        $totalPaid = $loan->repayments()->where('status', 'paid')->sum('amount_paid');
        $remainingBalance = $loan->total_amount - $totalPaid;

        return view('admin.loans.show', compact('loan', 'totalPaid', 'remainingBalance'));
    }

    /**
     * Approve loan
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $loan = Loan::findOrFail($id);
            
            $loan->update([
                'status' => 'approved',
                'approval_date' => now(),
                'admin_notes' => $request->admin_notes,
                'rejection_reason' => null,
            ]);

            // Generate repayment schedule
            $this->generateRepaymentSchedule($loan);

            DB::commit();

            return redirect()->route('admin.loans.index')
                ->with('success', 'Loan approved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to approve loan: ' . $e->getMessage());
        }
    }

    /**
     * Reject loan
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $loan = Loan::findOrFail($id);
        
        $loan->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Loan rejected successfully!');
    }

    /**
     * Mark loan as disbursed
     */
    public function disburse(Request $request, $id)
    {
        $request->validate([
            'disbursement_notes' => 'nullable|string|max:1000',
        ]);

        $loan = Loan::where('status', 'approved')->findOrFail($id);
        
        $loan->update([
            'status' => 'disbursed',
            'disbursement_date' => now(),
            'admin_notes' => $loan->admin_notes . "\n\nDisbursed: " . $request->disbursement_notes,
        ]);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Loan marked as disbursed successfully!');
    }

    /**
     * Update loan information
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|min:1000',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'tenure_months' => 'required|integer|min:1',
            'purpose' => 'required|string|max:500',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $loan = Loan::findOrFail($id);
            
            // Recalculate amounts
            $totalAmount = $this->calculateTotalAmount($request->loan_amount, $request->interest_rate, $request->tenure_months);
            $monthlyRepayment = $this->calculateMonthlyRepayment($totalAmount, $request->tenure_months);

            $loan->update([
                'loan_amount' => $request->loan_amount,
                'interest_rate' => $request->interest_rate,
                'tenure_months' => $request->tenure_months,
                'total_amount' => $totalAmount,
                'monthly_repayment' => $monthlyRepayment,
                'purpose' => $request->purpose,
                'admin_notes' => $request->admin_notes,
            ]);

            // Regenerate repayment schedule if loan is approved but not yet disbursed
            if ($loan->status == 'approved') {
                $loan->repayments()->delete();
                $this->generateRepaymentSchedule($loan);
            }

            DB::commit();

            return redirect()->route('admin.loans.index')
                ->with('success', 'Loan updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update loan: ' . $e->getMessage());
        }
    }

    /**
     * Generate repayment schedule
     */
    private function generateRepaymentSchedule($loan)
    {
        $repayments = [];
        $dueDate = now()->addMonth(); // First payment due in 1 month

        for ($i = 1; $i <= $loan->tenure_months; $i++) {
            $repayments[] = [
                'loan_id' => $loan->id,
                'installment_number' => $i,
                'amount_due' => $loan->monthly_repayment,
                'due_date' => $dueDate->copy()->addMonths($i - 1),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        LoanRepayment::insert($repayments);
    }

    /**
     * Calculate total amount
     */
    private function calculateTotalAmount($principal, $interestRate, $tenure)
    {
        $interest = ($principal * $interestRate * $tenure) / (12 * 100);
        return $principal + $interest;
    }

    /**
     * Calculate monthly repayment
     */
    private function calculateMonthlyRepayment($totalAmount, $tenure)
    {
        return $tenure > 0 ? round($totalAmount / $tenure, 2) : 0;
    }

    /**
     * Get loans by status
     */
    public function byStatus($status)
    {
        $validStatuses = ['pending', 'approved', 'rejected', 'disbursed', 'active', 'completed', 'defaulted'];
        
        if (!in_array($status, $validStatuses)) {
            abort(404);
        }

        $loans = Loan::with('user')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.loans.index', compact('loans', 'status'));
    }
}