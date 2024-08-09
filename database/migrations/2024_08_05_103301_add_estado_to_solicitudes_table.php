<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('Solicitudes', function (Blueprint $table) {
            $table->string('estado')->default('pendiente')->after('documento_pdf');
            $table->timestamp('fecha_respuesta')->nullable()->after('estado');
            $table->string('prioridad')->nullable()->after('fecha_respuesta');
            $table->string('categoria')->nullable()->after('prioridad');
            $table->string('referencia_externa')->nullable()->after('categoria');
            $table->json('archivos')->nullable()->after('referencia_externa');
            $table->unsignedBigInteger('id_usuario_responde')->nullable()->after('archivos');

            $table->foreign('id_usuario_responde')->references('id_usuario')->on('Usuarios')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('Solicitudes', function (Blueprint $table) {
            $table->dropForeign(['id_usuario_responde']);
            $table->dropColumn(['estado', 'fecha_respuesta', 'prioridad', 'categoria', 'referencia_externa', 'archivos', 'id_usuario_responde']);
        });
    }
};

