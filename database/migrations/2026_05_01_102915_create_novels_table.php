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
        Schema::create('novels', function (Blueprint $table) {
           $table->id();
        $table->foreignId('user_id'); // Sino ang author?
        $table->string('title'); // Pamagat ng military fantasy
        $table->text('description')->nullable(); // Synopsis o complex character psychology
        $table->string('cover_image')->nullable(); // Para sa book cover
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novels');
    }
};
