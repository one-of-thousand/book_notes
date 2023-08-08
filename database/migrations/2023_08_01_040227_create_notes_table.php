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
            $table->int('user_id');
            $table->string('title');
            $table->date('start');
            $table->date('end');
            $table->string('memo', 500);
            $table->string('publisher');
            $table->int('small_genre_id');
            $table->int('score');
            $table->string('outline', 500);
            $table->string('outline', 500);
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
