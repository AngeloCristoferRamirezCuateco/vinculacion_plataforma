<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create("Notificaciones", function(Blueprint $table){
            $table->bigIncrements("id_notificacion");
            $table->unsignedBigInteger("id_usuario");
            $table->timestamps();
            
            $table->foreign("id_usuario")->references("id_usuario")->on("Usuarios")->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists("Notificaciones");
    }
};
