<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Carbon\Carbon;

class GenerateLoanRepaymentsSeeder extends Seeder
{
    public function run()
    {
        $loans = Loan::whereIn('status', ['approved', 'active', 'disbursed'])
            ->whereDoesntHave('repayments')
            ->get();

        foreach ($loans as $loan) {
            $repayments = [];
            $dueDate = Carbon::now()->addMonth();

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
            
            $this->command->info("Generated {$loan->tenure_months} repayments for Loan #{$loan->id}");
        }
    }
}