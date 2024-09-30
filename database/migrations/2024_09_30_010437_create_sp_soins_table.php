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
        Schema::create('sp_soins', function (Blueprint $table) {
            $table->id();
            $table->string('montant');
            $table->unsignedBigInteger('soinsinfirmier_id');
            $table->foreign('soinsinfirmier_id')->references('id')->on('soinsinfirmiers')->onDelete('cascade');
            $table->unsignedBigInteger('soinspatient_id');
            $table->foreign('soinspatient_id')->references('id')->on('soinspatients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sp_soins');
    }
};
