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
        Schema::create('archivos_habitaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('habitacion_id')->constrained()->onDelete('cascade');
            $table->string('clasificacion_foto');
            $table->string('MIME');
            $table->string('ruta_archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos_habitaciones');
    }
};
