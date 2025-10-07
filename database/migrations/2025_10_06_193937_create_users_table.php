<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('password');
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('occupation', 100)->nullable();
            
            // Financial info
            $table->string('account_number', 20)->unique()->nullable();
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->decimal('annual_income', 15, 2)->nullable();
            $table->integer('credit_score')->default(0);
            
            // Security
            $table->string('two_fa_pin', 10)->nullable();
            $table->string('profile_image', 255)->nullable();
            
            // Loan-related
            $table->boolean('is_verified')->default(false);
            $table->enum('status', ['active','suspended','closed'])->default('active');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};