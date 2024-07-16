<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create("Documentos", function(Blueprint $table){
            $table->bigIncrements("id_documento");
            $table->unsignedBigInteger("id_usuario");
            $table->string("nombreDocumento");
            $table->string("tipoDocumento");
            $table->date("fechaCreacion");
            $table->timestamps();

            $table->foreign("id_usuario")->references("id_usuario")->on("Usuarios")->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists("Documentos");
    }
};
