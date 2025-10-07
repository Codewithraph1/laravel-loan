<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Show loan application form
     */
    public function create()
    {
        $user = Auth::user();

        // Check if user has pending loans
        $pendingLoans = Loan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'under_review'])
            ->count();

        if ($pendingLoans > 0) {
            return redirect()->route('user.loans.index')
                ->with('warning', 'You have a pending loan application. Please wait for it to be processed.');
        }

        return view('user.loans.create');
    }

    /**
     * Store loan application
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if user has pending loans
        $pendingLoans = Loan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'under_review'])
            ->count();

        if ($pendingLoans > 0) {
            return redirect()->route('user.loans.index')
                ->with('error', 'You already have a pending loan application. Please wait for it to be processed.');
        }

        // Validate the request
        // In your LoanController store method, update the validation rules:
        $validated = $request->validate([
            // Loan Details
            'loan_amount' => 'required|numeric|min:1000|max:10000000',
            'tenure_months' => 'required|integer|min:1|max:60', // Changed from 'in:3,6,12,24'
            'purpose' => 'required|string|max:500',

            // Address Information
            'house_address' => 'required|string|max:1000',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100', // Changed from select

            // Next of Kin
            'next_of_kin_fullname' => 'required|string|max:100',
            'next_of_kin_relationship' => 'required|string|max:50', // Changed from select
            'next_of_kin_phone' => 'required|string|max:20',
            'next_of_kin_address' => 'required|string|max:1000',

            // Bank Details
            'bank_name' => 'required|string|max:100', // Changed from select
            'account_number' => 'required|string|max:20',
            'account_name' => 'required|string|max:100',

            // Identification
            'valid_id_type' => 'required|string|max:50', // Changed from select
            'valid_id_number' => 'required|string|max:50',
            'valid_id_path' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Terms
            'terms' => 'required|accepted',
        ]);

        DB::beginTransaction();

        try {
            // Handle file upload
            if ($request->hasFile('valid_id_path')) {
                $file = $request->file('valid_id_path');
                $filename = 'ID_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('valid_ids', $filename, 'public');
            }

            // Calculate loan details based on Nigerian lending practices
            $interestRate = $this->calculateInterestRate($validated['loan_amount'], $validated['tenure_months'], $user->credit_score);
            $totalAmount = $this->calculateTotalAmount($validated['loan_amount'], $interestRate, $validated['tenure_months']);
            $monthlyRepayment = $this->calculateMonthlyRepayment($totalAmount, $validated['tenure_months']);

            // Create loan application
            $loan = Loan::create([
                'user_id' => $user->id,
                'loan_amount' => $validated['loan_amount'],
                'interest_rate' => $interestRate,
                'total_amount' => $totalAmount,
                'tenure_months' => $validated['tenure_months'],
                'monthly_repayment' => $monthlyRepayment,
                'purpose' => $validated['purpose'],
                'house_address' => $validated['house_address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'next_of_kin_fullname' => $validated['next_of_kin_fullname'],
                'next_of_kin_relationship' => $validated['next_of_kin_relationship'],
                'next_of_kin_phone' => $validated['next_of_kin_phone'],
                'next_of_kin_address' => $validated['next_of_kin_address'],
                'bank_name' => $validated['bank_name'],
                'account_number' => $validated['account_number'],
                'account_name' => $validated['account_name'],
                'valid_id_type' => $validated['valid_id_type'],
                'valid_id_number' => $validated['valid_id_number'],
                'valid_id_path' => $path,
                'application_date' => now(),
                'status' => 'pending',
            ]);

            DB::commit();

            // Send notification (you can implement this later)
            // $this->sendApplicationNotification($loan);

            return redirect()->route('user.loans.show', $loan->id)
                ->with('success', 'Loan application submitted successfully! We will review your application and get back to you soon.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded file if exists
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()
                ->with('error', 'Failed to submit loan application. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display user's loans
     */
    public function index()
    {
        $user = Auth::user();
        $loans = Loan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.loans.index', compact('loans'));
    }

    /**
     * Show specific loan details
     */
    public function show($id)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)
            ->with('repayments')
            ->findOrFail($id);

        // Calculate loan statistics
        $totalPaid = $loan->repayments()->where('status', 'paid')->sum('amount_paid');
        $remainingBalance = $loan->total_amount - $totalPaid;
        $nextPayment = $loan->repayments()->where('status', 'pending')->orderBy('due_date')->first();

        return view('user.loans.show', compact('loan', 'totalPaid', 'remainingBalance', 'nextPayment'));
    }

    /**
     * Show loan repayment page
     */
    public function showRepayment($id)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)
            ->with(['repayments' => function ($query) {
                $query->orderBy('due_date');
            }])
            ->findOrFail($id);

        if (!in_array($loan->status, ['active', 'disbursed'])) {
            return redirect()->route('user.loans.show', $loan->id)
                ->with('error', 'This loan is not active for repayment.');
        }

        $pendingRepayments = $loan->repayments()->where('status', 'pending')->get();
        $overdueRepayments = $loan->repayments()->where('status', 'overdue')->get();

        return view('user.loans.repayment', compact('loan', 'pendingRepayments', 'overdueRepayments'));
    }

    /**
     * Process loan repayment
     */
    public function processRepayment(Request $request, $id)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)->findOrFail($id);

        $request->validate([
            'repayment_id' => 'required|exists:loan_repayments,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:bank_transfer,card,ussd',
        ]);

        DB::beginTransaction();

        try {
            $repayment = LoanRepayment::where('loan_id', $loan->id)
                ->where('id', $request->repayment_id)
                ->firstOrFail();

            // Check if payment is sufficient
            if ($request->amount < $repayment->amount_due) {
                return redirect()->back()
                    ->with('error', 'Payment amount is less than the required installment.')
                    ->withInput();
            }

            // Update repayment record
            $repayment->update([
                'amount_paid' => $request->amount,
                'paid_date' => now(),
                'status' => 'paid',
                'payment_method' => $request->payment_method,
                'transaction_reference' => 'TXN_' . time() . '_' . $user->id,
            ]);

            // Update user's credit score (positive impact)
            $user->increment('credit_score', 5);

            // Check if all repayments are completed
            $pendingRepayments = $loan->repayments()->where('status', 'pending')->count();
            if ($pendingRepayments === 0) {
                $loan->update(['status' => 'completed']);
            }

            DB::commit();

            return redirect()->route('user.loans.show', $loan->id)
                ->with('success', 'Payment processed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Payment failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Calculate interest rate based on loan amount, tenure, and credit score
     */
    private function calculateInterestRate($loanAmount, $tenure, $creditScore)
    {
        $baseRate = 15.0; // Base interest rate 15%

        // Adjust based on loan amount (larger loans get better rates)
        if ($loanAmount > 500000) {
            $baseRate -= 2.0;
        } elseif ($loanAmount > 100000) {
            $baseRate -= 1.0;
        }

        // Adjust based on tenure (longer tenure = higher risk)
        if ($tenure > 12) {
            $baseRate += 2.0;
        }

        // Adjust based on credit score
        if ($creditScore > 800) {
            $baseRate -= 3.0;
        } elseif ($creditScore > 700) {
            $baseRate -= 1.5;
        } elseif ($creditScore < 500) {
            $baseRate += 2.0;
        }

        // Ensure rate is within reasonable bounds for Nigeria
        return max(10.0, min(25.0, $baseRate));
    }

    /**
     * Calculate total amount to be repaid
     */
    private function calculateTotalAmount($principal, $interestRate, $tenure)
    {
        // Simple interest calculation common in Nigeria
        $interest = ($principal * $interestRate * $tenure) / (12 * 100);
        return $principal + $interest;
    }

    /**
     * Calculate monthly repayment amount
     */
    private function calculateMonthlyRepayment($totalAmount, $tenure)
    {
        return $tenure > 0 ? round($totalAmount / $tenure, 2) : 0;
    }

    /**
     * Download loan agreement
     */
    public function downloadAgreement($id)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)->findOrFail($id);

        // Generate PDF agreement (you'll need to implement this)
        // For now, return a view
        return view('user.loans.agreement', compact('loan'));
    }

    /**
     * Cancel pending loan application
     */
    public function cancel($id)
    {
        $user = Auth::user();
        $loan = Loan::where('user_id', $user->id)
            ->where('status', 'pending')
            ->findOrFail($id);

        $loan->update([
            'status' => 'closed',
            'rejection_reason' => 'Cancelled by user'
        ]);

        return redirect()->route('user.loans.index')
            ->with('success', 'Loan application cancelled successfully.');
    }

    // In your LoanController - add this method
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

        // Insert all repayments at once
        LoanRepayment::insert($repayments);
    }
}
