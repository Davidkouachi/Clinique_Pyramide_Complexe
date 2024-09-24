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
        Schema::create('detailhopitals', function (Blueprint $table) {
            $table->id();
            $table->string('part_assurance');
            $table->string('part_patient');
            $table->string('remise');
            $table->string('montant');
            $table->string('date_debut');
            $table->string('date_fin');
            $table->unsignedBigInteger('natureadmission_id');
            $table->foreign('natureadmission_id')->references('id')->on('natureadmissions')->onDelete('cascade');
            $table->unsignedBigInteger('facture_id');
            $table->foreign('facture_id')->references('id')->on('factures')->onDelete('cascade');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->unsignedBigInteger('lit_id');
            $table->foreign('lit_id')->references('id')->on('lits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailhopitals');
    }
};
