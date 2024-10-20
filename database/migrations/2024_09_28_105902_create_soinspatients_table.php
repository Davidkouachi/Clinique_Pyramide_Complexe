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
        Schema::create('soinspatients', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index()->unique();
            $table->string('num_bon')->index()->nullable();
            $table->string('statut')->index();
            $table->string('part_assurance');
            $table->string('part_patient');
            $table->string('remise');
            $table->string('montant');
            $table->text('libelle')->nullable();
            $table->text('assurance_utiliser')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->unsignedBigInteger('facture_id');
            $table->foreign('facture_id')->references('id')->on('factures')->onDelete('cascade');
            $table->unsignedBigInteger('typesoins_id');
            $table->foreign('typesoins_id')->references('id')->on('typesoins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soinspatients');
    }
};
