<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create("AplicacionVacante",function(Blueprint $table){
            $table->bigIncrements("id_aplicante");
            $table->unsignedBigInteger("id_usuario");
            $table->unsignedBigInteger("id_vacante");
            $table->timestamps();

            $table->foreign("id_usuario")->references("id_usuario")->on("Usuarios")->onDelete("cascade");
            $table->foreign("id_vacante")->references("id_vacante")->on("Vacantes")->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists("AplicacionVacante");
    }
};
