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
        Schema::create('suscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('plan_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('status', 50);
            $table->timestamps();
            $table->string('subscription_type', 50)->nullable();
            $table->timestamp('renewal_date')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->foreignId('credit_card_id')->constrained();
            $table->timestamp('cancellation_date')->nullable();
            $table->timestamp('trial_end_date')->nullable();
            $table->longText('notes')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscription');
    }
};
