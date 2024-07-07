<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminGeneralTable extends Migration
{
    public function up()
    {
        Schema::create('admin_general', function (Blueprint $table) {
            $table->unsignedBigInteger('idUsuario');
            $table->string('rolUsuario', 20);
            $table->integer('esAdmin')->default(0);
            $table->timestamps();

            $table->primary('idUsuario');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios_institucion')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_general');
    }
}
