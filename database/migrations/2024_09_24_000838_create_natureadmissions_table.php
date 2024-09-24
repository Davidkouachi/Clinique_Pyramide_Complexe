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
        Schema::create('natureadmissions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('typeadmission_id');
            $table->foreign('typeadmission_id')->references('id')->on('typeadmissions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('natureadmissions');
    }
};
