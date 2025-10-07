<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Loan Details
            $table->decimal('loan_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2)->default(0.00);
            $table->decimal('total_amount', 15, 2)->default(0.00);
            $table->integer('tenure_months'); // Loan duration in months
            $table->decimal('monthly_repayment', 15, 2)->default(0.00);
            
            // Application Details
            $table->text('purpose');
            $table->string('house_address');
            $table->string('city');
            $table->string('state');
            
            // Next of Kin
            $table->string('next_of_kin_fullname');
            $table->string('next_of_kin_relationship');
            $table->string('next_of_kin_phone');
            $table->string('next_of_kin_address');
            
            // Bank Details for Disbursement
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            
            // Identification
            $table->string('valid_id_type'); // e.g., NIN, Driver's License, International Passport, Voter's Card
            $table->string('valid_id_number');
            $table->string('valid_id_path'); // File path for uploaded ID
            
            // Status and Tracking
            $table->enum('status', [
                'pending', 
                'under_review', 
                'approved', 
                'rejected', 
                'disbursed', 
                'active', 
                'completed', 
                'defaulted'
            ])->default('pending');
            
            $table->text('admin_notes')->nullable();
            $table->text('rejection_reason')->nullable();
            
            // Dates
            $table->date('application_date');
            $table->date('approval_date')->nullable();
            $table->date('disbursement_date')->nullable();
            $table->date('due_date')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('status');
            $table->index('application_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
};