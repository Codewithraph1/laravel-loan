<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained()->onDelete('cascade');
            $table->integer('installment_number');
            $table->decimal('amount_due', 15, 2);
            $table->decimal('amount_paid', 15, 2)->default(0.00);
            $table->date('due_date');
            $table->date('paid_date')->nullable();
            $table->enum('status', ['pending', 'paid', 'overdue', 'partial', 'pending_approval'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_reference')->nullable();
            
            // New columns for payment system
            $table->string('receipt_path')->nullable();
            $table->foreignId('admin_account_id')->nullable()->constrained('admin_account_details')->onDelete('cascade');
            $table->text('admin_notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('loan_id');
            $table->index('due_date');
            $table->index('status');
            $table->index('paid_date');
            
            // Unique constraint
            $table->unique(['loan_id', 'installment_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_repayments');
    }
};