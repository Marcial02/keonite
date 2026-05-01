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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id(); // Number ng chapter record
    $table->foreignId('novel_id'); // Koneksyon sa main book
    $table->string('title'); // Pamagat ng chapter (e.g., "The Siege")
    $table->longText('content'); // Dito mo itatype ang mahabang kwento mo
    $table->integer('chapter_number'); // Para alam kung ano ang Chapter 1, 2, 3
    $table->timestamps(); // Kailan mo sinulat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
    $table->id();
    $table->foreignId('novel_id')->constrained()->onDelete('cascade'); // Nakatali sa Novel
    $table->integer('chapter_number');
    $table->string('title');
    $table->longText('content'); // Dito papasok yung Tiptap HTML
    $table->timestamps();
});

        Schema::dropIfExists('chapters');

    }
};
