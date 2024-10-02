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
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('user_b_id');
            $table->foreign('user_b_id')->references('user_id')->on('users_b')->onDelete('cascade');
            $table->unsignedBigInteger('casa_id');
            $table->foreign('casa_id')->references('id')->on('casas')->onDelete('cascade');
            $table->timestamp('fecha');

            $table->primary(['user_b_id', 'casa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
