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
        Schema::table('notes', function (Blueprint $table) {
            $table->date('note_start_reading')->nullable()->change();
            $table->date('note_end_reading')->nullable()->change();
            $table->string('note_memo')->nullable()->change();
            $table->string('note_publisher')->nullable()->change();
            $table->foreignId('big_genre_id')->nullable()->change();
            $table->foreignId('small_genre_id')->nullable()->change();
            $table->string('note_outline')->nullable()->change();
            $table->string('note_impression')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            
        });
    }
};
