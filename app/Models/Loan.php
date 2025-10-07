<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_amount',
        'interest_rate',
        'total_amount',
        'tenure_months',
        'monthly_repayment',
        'purpose',
        'house_address',
        'city',
        'state',
        'next_of_kin_fullname',
        'next_of_kin_relationship',
        'next_of_kin_phone',
        'next_of_kin_address',
        'bank_name',
        'account_number',
        'account_name',
        'valid_id_type',
        'valid_id_number',
        'valid_id_path',
        'status',
        'admin_notes',
        'rejection_reason',
        'application_date',
        'approval_date',
        'disbursement_date',
        'due_date',
    ];

    protected $casts = [
        'loan_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'monthly_repayment' => 'decimal:2',
        'application_date' => 'date',
        'approval_date' => 'date',
        'disbursement_date' => 'date',
        'due_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repayments()
    {
        return $this->hasMany(LoanRepayment::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Helper Methods
    public function calculateTotalAmount()
    {
        $interest = ($this->loan_amount * $this->interest_rate * $this->tenure_months) / (12 * 100);
        return $this->loan_amount + $interest;
    }

    public function calculateMonthlyRepayment()
    {
        if ($this->tenure_months > 0) {
            return $this->total_amount / $this->tenure_months;
        }
        return 0;
    }

    public function getRemainingBalance()
    {
        $totalPaid = $this->repayments()->where('status', 'paid')->sum('amount_paid');
        return $this->total_amount - $totalPaid;
    }

    public function isOverdue()
    {
        return $this->repayments()->where('status', 'overdue')->exists();
    }
}