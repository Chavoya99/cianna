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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->foreignId('chat_id');
            $table->unsignedBigInteger('user_id_emisor');
            $table->foreign('user_id_emisor')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_receptor');
            $table->foreign('user_id_receptor')->references('id')->on('users')->onDelete('cascade');
            $table->string('username');
            $table->longText('contenido');
            $table->timestamp('fecha_hora')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
