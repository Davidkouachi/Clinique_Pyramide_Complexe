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
        Schema::create('typeactes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prix');
            $table->unsignedBigInteger('acte_id');
            $table->foreign('acte_id')->references('id')->on('actes')->onDelete('cascade');
            $table->string('cotation')->nullable();
            $table->string('valeur')->nullable();
            $table->string('montant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typeactes');
    }
};
