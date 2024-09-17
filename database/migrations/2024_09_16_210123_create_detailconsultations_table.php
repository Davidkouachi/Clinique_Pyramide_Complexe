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
        Schema::create('detailconsultations', function (Blueprint $table) {
            $table->id();
            $table->string('part_assurance')->nullable();
            $table->string('part_patient')->nullable();
            $table->string('remise')->nullable();
            $table->string('montant');
            $table->string('motif');
            $table->string('type_motif');
            $table->text('libelle')->nullable();
            $table->unsignedBigInteger('typeacte_id');
            $table->foreign('typeacte_id')->references('id')->on('typeactes')->onDelete('cascade');
            $table->unsignedBigInteger('consultation_id');
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailconsultations');
    }
};
