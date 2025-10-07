<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\AdminAccountDetail;
use App\Models\LoanRepayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show payment page for a loan
     */
    public function create($loanId)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)
            ->with(['repayments' => function($query) {
                $query->whereIn('status', ['pending', 'overdue'])
                      ->orderBy('due_date');
            }])
            ->findOrFail($loanId);

        // Check if loan is eligible for payment
        if (!in_array($loan->status, ['active', 'disbursed'])) {
            return redirect()->route('user.loans.show', $loan->id)
                ->with('error', 'This loan is not active for repayment.');
        }

        $adminAccounts = AdminAccountDetail::where('is_active', true)->get();
        $pendingRepayments = $loan->repayments->where('status', 'pending');
        $overdueRepayments = $loan->repayments->where('status', 'overdue');

        // Check if there are any repayments available
        if ($pendingRepayments->count() === 0 && $overdueRepayments->count() === 0) {
            return redirect()->route('user.loans.show', $loan->id)
                ->with('error', 'No installments available for payment. Please contact support.');
        }

        return view('user.payments.create', compact('loan', 'adminAccounts', 'pendingRepayments', 'overdueRepayments'));
    }

    /**
     * Process payment submission
     */
    public function store(Request $request, $loanId)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)->findOrFail($loanId);

        $request->validate([
            'admin_account_id' => 'required|exists:admin_account_details,id',
            'repayment_id' => 'required|exists:loan_repayments,id',
            'amount_paid' => 'required|numeric|min:0.01',
            'transaction_reference' => 'required|string|max:100',
            'payment_method' => 'required|string|in:bank_transfer,card,ussd,cash',
            'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_date' => 'required|date|before_or_equal:today',
        ]);

        DB::beginTransaction();

        try {
            // Handle receipt upload
            if ($request->hasFile('receipt')) {
                $file = $request->file('receipt');
                $filename = 'receipt_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('payment_receipts', $filename, 'public');
            }

            // Get the repayment and verify it belongs to the user's loan
            $repayment = LoanRepayment::where('loan_id', $loan->id)
                ->where('id', $request->repayment_id)
                ->firstOrFail();

            // Check if the repayment is already paid or pending approval
            if (in_array($repayment->status, ['paid', 'pending_approval'])) {
                return redirect()->back()
                    ->with('error', 'This installment already has a payment submitted.')
                    ->withInput();
            }

            // Validate amount paid against amount due
            $amountDue = $repayment->amount_due;
            $amountPaid = $request->amount_paid;

            // Determine the status based on payment amount
            if ($amountPaid >= $amountDue) {
                $status = 'pending_approval';
            } elseif ($amountPaid > 0) {
                $status = 'pending_approval'; // Partial payments also need approval
            } else {
                return redirect()->back()
                    ->with('error', 'Payment amount must be greater than 0.')
                    ->withInput();
            }

            // Update repayment record with payment details
            $repayment->update([
                'amount_paid' => $amountPaid,
                'payment_method' => $request->payment_method,
                'transaction_reference' => $request->transaction_reference,
                'receipt_path' => $path,
                'paid_date' => $request->payment_date,
                'admin_account_id' => $request->admin_account_id,
                'status' => $status,
                'admin_notes' => 'Payment submitted - waiting for admin approval',
            ]);

            DB::commit();

            return redirect()->route('user.loans.show', $loan->id)
                ->with('success', 'Payment submitted successfully! It will be reviewed by our team.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded file if exists
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()
                ->with('error', 'Failed to submit payment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show payment history for a loan
     */
    public function loanPayments($loanId)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)->findOrFail($loanId);
        
        $repayments = LoanRepayment::where('loan_id', $loanId)
            ->whereNotNull('amount_paid')
            ->where('amount_paid', '>', 0)
            ->orderBy('paid_date', 'desc')
            ->get();

        return view('user.payments.history', compact('loan', 'repayments'));
    }
}