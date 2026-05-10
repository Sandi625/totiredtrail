<?php

// database/migrations/xxxx_xx_xx_create_tours_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


   public function up(): void
{
    Schema::create('tours', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('thumbnail')->nullable();
        $table->json('images')->nullable();
        $table->decimal('price', 10, 2);
        $table->text('description')->nullable();
        $table->string('route_name')->nullable(); // <- Tambahkan ini
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
