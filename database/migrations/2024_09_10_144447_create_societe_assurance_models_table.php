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
        Schema::create('societes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('fax')->unique()->nullable();
            $table->string('tel')->unique()->index();
            $table->string('tel2')->unique()->nullable();
            $table->string('adresse')->nullable();
            $table->string('sgeo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('societes');
    }
};
