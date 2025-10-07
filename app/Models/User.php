<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'password',
        'address',
        'city',
        'state',
        'country',
        'date_of_birth',
        'occupation',
        'account_number',
        'balance',
        'annual_income',
        'credit_score',
        'two_fa_pin',
        'profile_image',
        'is_verified',
        'status'
    ];

    protected $hidden = [
        'password',
        'two_fa_pin',
        'remember_token',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'balance' => 'decimal:2',
        'annual_income' => 'decimal:2',
        'is_verified' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoans()
    {
        return $this->hasMany(Loan::class)->whereIn('status', ['active', 'disbursed']);
    }

    public function pendingLoans()
    {
        return $this->hasMany(Loan::class)->where('status', 'pending');
    }
}