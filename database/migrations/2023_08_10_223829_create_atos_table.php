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
        Schema::create('atos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 30);
            $table->integer('quantidade');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();
        });

        Schema::table('atos', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atos');
    }
};
