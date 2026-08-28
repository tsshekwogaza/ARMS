<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Landlord ID
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('receipt_number')->unique(); // e.g., "RCT-ABJ-2026-001"
            $table->decimal('amount_paid', 12, 2); // Handles high amounts (e.g., ₦5,000,000.00)
            $table->string('payment_method'); // Bank Transfer, Cash, Cheque, POS, etc.
            $table->date('rent_start_date');
            $table->date('rent_end_date');
            $table->date('payment_date');
            $table->string('pdf_path')->nullable();
            $table->string('status')->default('draft'); // 'draft', 'issued', 'sent_whatsapp', 'sent_email'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
