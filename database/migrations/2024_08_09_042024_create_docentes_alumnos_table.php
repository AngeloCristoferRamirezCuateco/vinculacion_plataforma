<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('docente_alumno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('alumno_id');
            $table->timestamps();

            $table->foreign('docente_id')->references('id_usuario')->on('Usuarios')->onDelete('cascade');
            $table->foreign('alumno_id')->references('id_usuario')->on('Usuarios')->onDelete('cascade');

            $table->unique(['docente_id', 'alumno_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('docente_alumno');
    }
};
