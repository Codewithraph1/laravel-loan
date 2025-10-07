<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanRepayment;
use App\Models\AdminAccountDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPaymentController extends Controller
{
    /**
     * Show pending payments for approval
     */
    public function pendingPayments()
    {
        // FIXED: Changed 'payment_status' to 'status'
        $payments = LoanRepayment::where('status', 'pending_approval')
            ->whereNotNull('amount_paid')
            ->where('amount_paid', '>', 0)
            ->with(['loan.user', 'adminAccount'])
            ->orderBy('paid_date', 'desc')
            ->paginate(10);

        return view('admin.payments.pending', compact('payments'));
    }

    /**
     * Show payment details for approval
     */
    public function showPayment($id)
    {
        $payment = LoanRepayment::with(['loan.user', 'adminAccount'])
            ->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Approve a payment
     */
    public function approvePayment(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $payment = LoanRepayment::findOrFail($id);

            // FIXED: Changed 'payment_status' to 'status'
            if ($payment->status !== 'pending_approval') {
                return redirect()->back()
                    ->with('error', 'This payment has already been processed.');
            }

            // Calculate final status based on amount paid
            $finalStatus = $this->calculatePaymentStatus($payment->amount_paid, $payment->amount_due);

            // Update payment status
            $payment->update([
                'status' => $finalStatus, // FIXED: Use 'status' not 'payment_status'
                'approved_at' => now(),
                'admin_notes' => $request->admin_notes,
            ]);

            // Update loan status if all payments are completed
            $this->updateLoanStatus($payment->loan_id);

            DB::commit();

            return redirect()->route('admin.payments.pending')
                ->with('success', 'Payment approved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to approve payment: ' . $e->getMessage());
        }
    }

    /**
     * Reject a payment
     */
    public function rejectPayment(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $payment = LoanRepayment::findOrFail($id);

        // FIXED: Changed 'payment_status' to 'status'
        if ($payment->status !== 'pending_approval') {
            return redirect()->back()
                ->with('error', 'This payment has already been processed.');
        }

        $payment->update([
            'status' => 'pending', // Reset to pending so user can try again
            'amount_paid' => 0, // Reset amount paid
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
            'admin_notes' => $request->admin_notes,
            'receipt_path' => null, // Remove receipt path
            'transaction_reference' => null, // Remove transaction reference
            'payment_method' => null, // Remove payment method
            'paid_date' => null, // Remove paid date
        ]);

        return redirect()->route('admin.payments.pending')
            ->with('success', 'Payment rejected successfully!');
    }

    /**
     * Calculate payment status based on amount paid
     */
    private function calculatePaymentStatus($amountPaid, $amountDue)
    {
        if ($amountPaid >= $amountDue) {
            return 'paid';
        } elseif ($amountPaid > 0) {
            return 'partial';
        } else {
            return 'pending';
        }
    }

    /**
     * Update loan status if all payments are completed
     */
    private function updateLoanStatus($loanId)
    {
        $loan = \App\Models\Loan::find($loanId);
        if (!$loan) return;

        $pendingPayments = LoanRepayment::where('loan_id', $loanId)
            ->whereIn('status', ['pending', 'overdue', 'partial', 'pending_approval'])
            ->count();

        if ($pendingPayments === 0) {
            $loan->update(['status' => 'completed']);
        }
    }

    /**
     * Show all payments (approved and rejected)
     */
    public function allPayments()
    {
        $payments = LoanRepayment::whereNotNull('amount_paid')
            ->where('amount_paid', '>', 0)
            ->with(['loan.user', 'adminAccount'])
            ->orderBy('paid_date', 'desc')
            ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }
}