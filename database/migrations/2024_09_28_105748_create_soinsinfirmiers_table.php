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
        Schema::create('soinsinfirmiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prix');
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
        Schema::dropIfExists('soinsinfirmiers');
    }
};
