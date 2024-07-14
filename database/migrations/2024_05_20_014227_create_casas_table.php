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
        Schema::create('casas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_a_id');
            $table->foreign('user_a_id')->references('user_id')->on('users_a')->onDelete('cascade');
            $table->string('calle');
            $table->smallInteger('num_ext');
            $table->smallInteger('num_int')->nullable();
            $table->bigInteger('codigo_postal');
            $table->string('ciudad');
            $table->string('colonia');
            $table->string('descripcion', length:300);
            $table->string('acepta_mascotas', length:2);
            $table->string('acepta_visitas', length:2);
            $table->string('riguroza_limpieza', length:2);
            $table->string('regla_adicional')->nullable();
            $table->string('muebles', length: 2);
            $table->string('servicios', length: 2);
            $table->string('requisitos', length: 300);
            $table->smallInteger('precio')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casas');
    }
};
