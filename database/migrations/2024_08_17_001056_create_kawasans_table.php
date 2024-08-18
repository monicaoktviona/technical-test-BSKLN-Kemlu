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
        Schema::create('kawasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_direktorat');
            $table->string('nama_kawasan');
            $table->timestamps();

            $table->foreign('id_direktorat')->references('id')->on('direktorats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kawasans');
    }
};
