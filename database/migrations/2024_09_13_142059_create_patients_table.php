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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('np')->index();
            $table->string('email')->index()->unique();
            $table->string('tel')->index()->unique();
            $table->string('tel2')->index()->unique()->nullable();
            $table->string('assurer')->index();
            $table->string('matricule')->index()->unique();
            $table->string('adresse');
            $table->unsignedBigInteger('assurance_id')->nullable();
            $table->foreign('assurance_id')->references('id')->on('assurances')->onDelete('cascade');
            $table->unsignedBigInteger('taux_id')->nullable();
            $table->foreign('taux_id')->references('id')->on('tauxes')->onDelete('cascade');
            $table->unsignedBigInteger('societe_id')->nullable();
            $table->foreign('societe_id')->references('id')->on('societes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
