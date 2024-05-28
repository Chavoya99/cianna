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
            $table->smallInteger('edad');
            $table->string('sexo');
            $table->string('descripcion');
            $table->string('gustos_intereses');
            $table->string('carrera');
            $table->string('codigo');
            $table->timestamps();
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
