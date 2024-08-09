<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id('id_convenio');
            $table->unsignedBigInteger('id_usuario_emisor');
            $table->unsignedBigInteger('id_usuario_receptor');
            $table->string('documento_emisor')->nullable();
            $table->string('documento_receptor')->nullable();
            $table->string('estado')->default('pendiente');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->timestamp('fecha_aceptacion')->nullable();
            $table->timestamp('fecha_finalizacion')->nullable();

            // Definir claves foráneas
            
            $table->foreign('id_usuario_emisor')->references('id_usuario')->on('Usuarios')->onDelete('cascade');
            $table->foreign('id_usuario_receptor')->references('id_usuario')->on('Usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('convenios');
    }
};

