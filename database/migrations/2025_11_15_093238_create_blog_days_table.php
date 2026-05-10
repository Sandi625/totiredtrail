<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');

           $table->string('title')->nullable();            // Judul day (nullable karena tidak required)
    $table->text('description')->nullable();

            // Tambahan image untuk per hari
            $table->string('image')->nullable();
            $table->string('image_title')->nullable();       // Judul image
            $table->text('image_description')->nullable();  // Deskripsi image

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_days');
    }
};
