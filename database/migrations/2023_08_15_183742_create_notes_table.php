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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('note_title');
            $table->date('note_start_reading')->nullable();
            $table->date('note_end_reading')->nullable();
            $table->string('note_memo')->nullable();
            $table->string('note_publisher')->nullable();
            $table->foreignId('big_genre_id')->constrained();
            $table->foreignId('small_genre_id')->constrained();
            $table->integer('note_score');
            $table->text('note_outline')->nullable();
            $table->text('note_impression')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
