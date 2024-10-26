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
        Schema::create('historiquecaisses', function (Blueprint $table) {
            $table->id();
            $table->string('motif');
            $table->string('montant');
            $table->string('libelle')->nullable();
            $table->string('solde_avant');
            $table->string('solde_apres');
            $table->string('typemvt')->index();
            $table->string('date_ope')->index();
            $table->unsignedBigInteger('creer_id');
            $table->foreign('creer_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiquecaisses');
    }
};
