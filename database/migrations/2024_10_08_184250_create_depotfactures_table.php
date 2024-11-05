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
        Schema::create('depotfactures', function (Blueprint $table) {
            $table->id();
            $table->string('date1');
            $table->string('date2');
            $table->string('date_depot');
            $table->string('type_paiement')->nullable();
            $table->string('num_cheque')->nullable();
            $table->string('date_payer')->nullable();
            $table->string('statut')->index();
            $table->unsignedBigInteger('assurance_id');
            $table->foreign('assurance_id')->references('id')->on('assurances')->onDelete('cascade');
            $table->unsignedBigInteger('creer_id');
            $table->foreign('creer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('encaisser_id');
            $table->foreign('encaisser_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depotfactures');
    }
};
