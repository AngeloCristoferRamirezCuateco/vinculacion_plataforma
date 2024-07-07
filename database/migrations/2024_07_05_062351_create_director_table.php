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
        Schema::create('director', function (Blueprint $table) {
            $table->unsignedBigInteger('idUsuario')->primary();
            $table->unsignedBigInteger('idInstitucion');
            $table->string('rolUsuario', 100);
            $table->integer('esAdmin')->default(0);
            $table->timestamps();

            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios_institucion')->onDelete('cascade');
            $table->foreign('idInstitucion')->references('idInstitucion')->on('instituciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director');
    }
};
