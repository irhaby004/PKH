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
        Schema::create('dataset_detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_kriteria', 255);
            $table->timestamps();
            $table->string('id_dataset', 255);
            $table->Integer('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dataset_detail');
    }
};
