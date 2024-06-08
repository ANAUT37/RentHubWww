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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('display_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('type');// 0 PARTICULAR - 1 EMPRESA
            $table->string('phone');
            $table->string('phone_code');
            $table->string('second_mail')->nullable();
            $table->string('country_code');
            $table->string('profile_pic_url')->nullable();
            $table->string('profile_banner_url')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->integer('login_attempts')->default(0);
            $table->integer('two_factor_actived')->default(0);
            $table->integer('status')->default(1);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('users_particular', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('name');
            $table->string('surname');
            $table->integer('plan');
            $table->timestamp('birthdate');
            $table->string('genre');
            $table->integer('verified')->nullable();
            $table->timestamps();
        });

        Schema::create('users_enterprise', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('company_name');
            $table->string('display_name');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_phone_code')->nullable();
            $table->integer('verified')->nullable();
            $table->timestamps();
        });

        Schema::create('users_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->integer('on_message')->default(1);
            $table->integer('on_login')->default(1);
            $table->integer('on_comment')->default(1);
            $table->integer('on_system')->default(1);
            $table->integer('on_ads')->default(1);
            $table->timestamps();
        });

        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('number');
            $table->timestamp('expiration_date');
            $table->string('cvv');
            $table->string('full_name');
            $table->timestamp('last_used')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users_particular');
        Schema::dropIfExists('users_enterprise');
        Schema::dropIfExists('users_notification_settings');
        Schema::dropIfExists('credit_cards');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
