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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('display_id');
            $table->string('category');
            $table->string('display_name')->nullable();
            $table->string('chat_id');
            $table->string('bank_account_id');
            $table->string('document_id');
            $table->foreignId('inmueble_id')->constrained()->cascadeOnDelete();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->float('price');
            $table->float('bail');
            $table->longText('rules');
            $table->string('payment_frequency')->default('month');
            $table->timestamps();
        });

        Schema::create('contract_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('start_period');
            $table->timestamp('end_period');
            $table->longText('transaction_id');  // encriptado
            $table->longText('amount');  // encriptado
            $table->longText('currency');  // encriptado
            $table->longText('payment_method_id');  // encriptado
            $table->longText('payment_status');  // encriptado
            $table->longText('description')->nullable();  // encriptado
            $table->longText('billing_details')->nullable();  // encriptado
            $table->longText('customer_email')->nullable();  // encriptado
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('contract_participants', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('contract_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('pending');
            $table->foreignId('credit_card_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('contract_associated_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->longText('company_name');  // encriptado
            $table->longText('policy_number');  // encriptado
            $table->timestamp('start_insurance_date');
            $table->timestamp('end_insurance_date');
            $table->longText('description')->nullable();  // encriptado
            $table->longText('insured_amount')->nullable();  // encriptado
            $table->longText('insurance_cost');  // encriptado
            $table->longText('contact_information');  // encriptado
            $table->timestamps();
        });

        Schema::create('contract_associated_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->longText('provider_name');  // encriptado
            $table->longText('description')->nullable();  // encriptado
            $table->longText('service_cost');  // encriptado
            $table->timestamp('start_service_date');
            $table->timestamp('end_service_date');
            $table->longText('service_frequency')->nullable();  // encriptado
            $table->longText('contact_information');  // encriptado
            $table->timestamps();
        });

        Schema::create('contract_incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reported_by')->constrained('users')->cascadeOnDelete();
            $table->timestamp('incident_date');
            $table->string('type');
            $table->longText('description');
            $table->string('status')->default('pending');
            $table->longText('resolution')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract');
        Schema::dropIfExists('contract_transactions');
        Schema::dropIfExists('contract_participants');
        Schema::dropIfExists('contract_associated_ensurences');
        Schema::dropIfExists('contract_associated_services');
        Schema::dropIfExists('contract_incidents');
    }
};
