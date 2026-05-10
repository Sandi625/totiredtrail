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
       Schema::create('tour_days', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tour_id')->constrained()->onDelete('cascade'); // relasi ke tour
    $table->string('title'); // misal "Day 1: SURABAYA - ACOMMODATION..."
    $table->text('description'); // deskripsi panjang hari tersebut
    $table->string('image')->nullable(); // path image hari
    $table->string('image_title')->nullable(); // judul image
    $table->text('image_description')->nullable(); // deskripsi image
    $table->integer('order')->default(1); // urutan hari
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_days');
    }
};
