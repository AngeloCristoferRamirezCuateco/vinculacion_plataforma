<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Solicitudes', function (Blueprint $table) {
            $table->bigIncrements('id_solicitud');
            $table->unsignedBigInteger('id_usuario_emisor');
            $table->unsignedBigInteger('id_usuario_remitente');
            $table->binary('documento_pdf')->nullable(); 
            $table->string('tipoSolicitud');
            $table->integer('tiempo_respuesta')->nullable();
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario_emisor')->references('id_usuario')->on('Usuarios')->onDelete('cascade');
            $table->foreign('id_usuario_remitente')->references('id_usuario')->on('Usuarios')->onDelete('cascade');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('Solicitudes');
    }
};
