<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAccountDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'account_name',
        'account_number',
        'bank_code',
        'currency',
        'instructions',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function payments()
    {
        return $this->hasMany(LoanRepayment::class, 'admin_account_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helper Methods
    public function getFullAccountInfoAttribute()
    {
        return "{$this->bank_name} - {$this->account_name} - {$this->account_number}";
    }
}