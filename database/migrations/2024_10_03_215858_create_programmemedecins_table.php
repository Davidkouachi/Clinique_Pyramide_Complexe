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
        Schema::create('programmemedecins', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->string('heure_debut');
            $table->string('heure_fin');
            $table->string('statut');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('jour_id');
            $table->foreign('jour_id')->references('id')->on('joursemaines')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmemedecins');
    }
};
