<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->bigIncrements('id_proyecto');
            $table->unsignedBigInteger('id_convenio');
            $table->string('empresa_pertenencia');
            $table->string('proposito');
            $table->string('metas');
            $table->string('alcance');
            $table->string('nombre_proyecto');
            $table->string('participantes');
            $table->timestamps();
            
            $table->foreign('id_convenio')->references('id_convenio')->on('convenios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
};

