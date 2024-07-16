<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create("Solicitudes", function(Blueprint $table){
            $table->bigIncrements("id_solicitud");
            $table->unsignedBigInteger("id_usuario_emisor");
            $table->unsignedBigInteger("id_usuario_remitente");
            $table->unsignedBigInteger("id_notificacion");
            $table->string("tipoSolicitud");
            $table->timestamps();

            $table->foreign("id_usuario_emisor")->references("id_usuario")->on("Usuarios")->onDelete("cascade");
            $table->foreign("id_usuario_remitente")->references("id_usuario")->on("Usuarios")->onDelete("cascade");
            $table->foreign("id_notificacion")->references("id_notificacion")->on("Notificaciones")->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists("Solicitudes");
    }
};
