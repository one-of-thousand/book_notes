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
        Schema::create('planed_books', function (Blueprint $table) {
            $table->id();
            $table->string('planed_book_title');
            $table->string('planed_book_author');
            $table->string('planed_book_importance');
            $table->string('planed_book_state');
            $table->timestamps();           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planed_books');
    }
};
