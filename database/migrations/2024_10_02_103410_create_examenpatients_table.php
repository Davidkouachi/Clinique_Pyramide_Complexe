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
        Schema::create('examenpatients', function (Blueprint $table) {
            $table->id();
            $table->string('accepte');
            $table->unsignedBigInteger('typeacte_id');
            $table->foreign('typeacte_id')->references('id')->on('typeactes')->onDelete('cascade');
            $table->unsignedBigInteger('examen_id');
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examenpatients');
    }
};
