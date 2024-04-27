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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('display_id')->unique();
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->string('address');
            $table->string('category');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('display_id')->unique();
            $table->foreignId('inmueble_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('price');
            $table->integer('visibility')->default(1);
            $table->timestamps();
        });

        Schema::create('inmueble_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('display_name');
            $table->string('description')->nullable();
            $table->string('icon_url')->nullable();
            $table->timestamps();
        });

        Schema::create('inmueble_attributes_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->cascadeOnDelete();
            $table->string('value');
            $table->foreignId('inmueble_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('inmueble_images', function (Blueprint $table) {
            $table->id();
            $table->string('url_image');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->string('file_type');
            $table->string('size')->nullable();
            $table->foreignId('inmueble_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncios');
        Schema::dropIfExists('inmuebles');
        Schema::dropIfExists('inmueble_attributes');
        Schema::dropIfExists('inmueble_attributes_values');
        Schema::dropIfExists('inmueble_images');
    }
};
