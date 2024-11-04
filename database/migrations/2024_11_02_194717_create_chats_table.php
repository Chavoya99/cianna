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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->unsignedBigInteger('user_a_id');
            $table->foreign('user_a_id')->references('user_id')->on('users_a')->onDelete('cascade');
            $table->unsignedBigInteger('user_b_id');
            $table->foreign('user_b_id')->references('user_id')->on('users_b')->onDelete('cascade');
            $table->timestamp('fecha_hora_creacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
