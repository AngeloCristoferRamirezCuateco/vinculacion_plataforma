<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosInstitucionTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios_institucion', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->unsignedBigInteger('idInstitucion');
            $table->integer('esAdmin');
            $table->string('nombreUsuario', 100);
            $table->string('apellidoMaterno', 100);
            $table->string('apellidoPaterno', 100);
            $table->string('correoUsuario', 250);
            $table->string('passwordUsuario', 250);
            $table->string('rolUsuario', 100);
            $table->date('fechaCreacionCuenta');
            $table->timestamps();

            $table->foreign('idInstitucion')->references('idInstitucion')->on('instituciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios_institucion');
    }
}
