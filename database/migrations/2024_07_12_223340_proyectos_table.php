<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('Proyectos',function (Blueprint $table){
            $table->bigIncrements("id_proyecto");
            $table->unsignedBigInteger("id_convenio");
            $table->string("proposito");
            $table->string("metas");
            $table->string("alcance");
            $table->string("participantes");
            $table->timestamps();
            
            $table->foreign("id_convenio")->references("id_convenio")->on("Convenios")->onDelete("cascade");
        });
    }

    
    public function down()
    {
        Schema::dropIfExists("Proyectos");
    }
};
