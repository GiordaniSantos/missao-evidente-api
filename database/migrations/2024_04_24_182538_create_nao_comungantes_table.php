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
        Schema::create('nao_comungantes', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade')->default(0);
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();
        });
        
        Schema::table('nao_comungantes', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nao_comungantes');
    }
};
