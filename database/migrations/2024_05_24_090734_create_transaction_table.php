<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->longText('transaction_id');
            $table->longText('amount');
            $table->longText('currency');
            $table->longText('payment_method_id');
            $table->longText('payment_status');
            $table->longText('description')->nullable();
            $table->longText('billing_details')->nullable();
            $table->longText('customer_email')->nullable();
            $table->boolean('save_card')->default(false);
            $table->json('metadata')->nullable();
            $table->timestamp('last_used')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
