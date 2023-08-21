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
        Schema::create('bunsyos', function (Blueprint $table) {
            $table->id();
            $table->integer('note_id');
            $table->integer('user_id');
            $table->integer('sentence_page');
            $table->string('tag_name');
            $table->string('sentence_body');
            $table->string('sentence_memo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bunsyos');
    }
};
