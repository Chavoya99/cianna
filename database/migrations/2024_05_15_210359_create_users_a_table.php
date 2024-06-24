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
        Schema::create('users_a', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('registro_completo')->nullable(); //Se actualiza con el registro de casa
            $table->smallInteger('edad');
            $table->string('sexo');
            $table->string('descripcion', length:300);
            $table->string('mascota');
            $table->smallInteger('num_mascotas')->default(0);
            $table->string('padecimiento');
            $table->string('nom_padecimiento')->default('N/A');
            $table->string('lifestyle');
            $table->string('carrera');
            $table->string('codigo');
            $table->timestamps();

            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_a');
    }
};
