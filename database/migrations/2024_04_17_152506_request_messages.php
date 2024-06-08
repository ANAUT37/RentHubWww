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
        Schema::create('chats_request', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('display_id')->unique();
            $table->string('chat_name')->nullable();
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->string('chat_image_url')->nullable();
            $table->string('anuncio_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats_request');
    }
};
