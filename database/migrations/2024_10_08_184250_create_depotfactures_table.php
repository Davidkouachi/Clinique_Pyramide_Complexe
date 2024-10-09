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
            $table->string('num_cheque')->nullable();
            $table->string('date_payer')->nullable();
            $table->string('statut')->index();
            $table->unsignedBigInteger('assurance_id');
            $table->foreign('assurance_id')->references('id')->on('assurances')->onDelete('cascade');
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
