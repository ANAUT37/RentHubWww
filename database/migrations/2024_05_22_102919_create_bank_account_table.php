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
        Schema::create('bank_account', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->longText('holder_name')->nullable(false);
            $table->longText('number')->nullable(false);
            $table->longText('type')->nullable(false);
            $table->longText('bank_name')->nullable(false);
            $table->longText('bank_code')->nullable(false);
            $table->longText('iban')->nullable(false);
            $table->longText('branch_address')->nullable(false);
            $table->longText('holder_address')->nullable(false);
            $table->timestamp('last_used')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_account');
    }
};
