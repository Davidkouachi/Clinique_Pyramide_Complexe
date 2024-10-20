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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('statut')->index();
            $table->string('montant_verser')->nullable();
            $table->string('montant_remis')->nullable();
            $table->string('code')->index()->unique();
            $table->string('date_payer')->index()->nullable();
            $table->string('acte')->nullable();
            $table->unsignedBigInteger('creer_id')->nullable();
            $table->foreign('creer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('encaisser_id')->nullable();
            $table->foreign('encaisser_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
