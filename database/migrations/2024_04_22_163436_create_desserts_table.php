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
        Schema::create('desserts', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->string('picture');
            $table->longText('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->integer('price');
            $table->enum('status', ['show', 'hide'])->default('hide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desserts');
    }
};
