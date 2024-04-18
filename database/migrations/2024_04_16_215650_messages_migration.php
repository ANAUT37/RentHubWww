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
        Schema::create('chats', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('display_id')->unique();
            $table->string('chat_name')->nullable();
            $table->string('chat_image_url')->nullable();
            $table->string('anuncio_id');
            $table->timestamps();
        });

        Schema::create('chats_participants', function(Blueprint $table){
            $table->string('id')->primary();
            $table->foreignId('user_id')->index();
            $table->foreignId('chat_id')->index();
            $table->timestamps();
        });

        Schema::create('chats_messages', function(Blueprint $table){
            $table->string('id')->primary();
            $table->foreignId('user_id')->index();
            $table->foreignId('chat_id')->index();
            $table->foreignId('answer_to')->index()->nullable();
            $table->int('seen')->default(0);
            $table->string('type');
            $table->longText('text')->nullable();
            $table->string('file_type')->nullable();
            $table->longText('file_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
        Schema::dropIfExists('chats_participants');
        Schema::dropIfExists('chats_messages');
    }
};
