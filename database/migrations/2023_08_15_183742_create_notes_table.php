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
            $table->date('note_start_reading');
            $table->date('note_end_reading');
            $table->string('note_memo');
            $table->string('note_publisher');
            $table->foreignId('big_genre_id')->constrained();
            $table->foreignId('small_genre_id')->constrained();
            $table->integer('note_score');
            $table->string('note_outline');
            $table->string('note_impression');
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
