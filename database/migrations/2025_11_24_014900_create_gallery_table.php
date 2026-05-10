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
    Schema::create('gallery', function (Blueprint $table) {
        $table->id();
        $table->string('judul')->nullable();
        $table->text('deskripsi')->nullable();

        $table->string('gambar')->nullable();      // path gambar
        $table->string('video_local')->nullable(); // path video lokal
        $table->string('video_yt')->nullable();    // url YouTube

        $table->boolean('status')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
