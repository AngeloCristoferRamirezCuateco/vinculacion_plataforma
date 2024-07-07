<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitucionesTable extends Migration
{
    public function up()
    {
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id('idInstitucion');
            $table->string('nombreInstitucion', 250);
            $table->string('tipoInstitucion', 50);
            $table->string('disposicionInstitucion', 50);
            $table->string('telefonoInstitucion', 20);
            $table->string('correoInstitucion', 100);
            $table->string('passwordInstitucion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instituciones');
    }
}
