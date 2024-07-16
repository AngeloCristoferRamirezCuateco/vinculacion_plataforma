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
        Schema::create("Vacantes", function(Blueprint $table){
            $table->bigIncrements("id_vacante");
            $table->unsignedBigInteger("id_empresa");
            $table->string("proyectoDisponible");
            $table->integer("numeroVacantes");
            $table->string("datosVacante");
            $table->string("estadoVacante");
            $table->timestamps();

            $table->foreign("id_empresa")->references("id_empresa")->on("Empresas")->onDelete("cascade");
        });
    }
    
    public function down()
    {
        Schema::dropIfExists("Vacantes");
    }
};
