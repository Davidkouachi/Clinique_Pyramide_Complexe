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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('part_assurance');
            $table->string('part_patient');
            $table->string('montant');
            $table->string('statut');
            $table->text('libelle');
            $table->string('code')->index()->unique();
            $table->string('medecin');
            $table->string('prelevement');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->unsignedBigInteger('facture_id');
            $table->foreign('facture_id')->references('id')->on('factures')->onDelete('cascade');
            $table->unsignedBigInteger('acte_id');
            $table->foreign('acte_id')->references('id')->on('actes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
