<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddFieldsToAplicacionVacanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('AplicacionVacante', function (Blueprint $table) {
            // Agregar nuevos campos
            $table->binary('curriculumUsuario')->nullable()->after('id_vacante');
            $table->date('fechaAplicacion')->default(DB::raw('CURRENT_DATE'))->after('curriculumUsuario');
            $table->string('estadoSolicitud')->default('Pendiente')->after('fechaAplicacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('AplicacionVacante', function (Blueprint $table) {
            // Eliminar los campos en la reversión de la migración
            $table->dropColumn(['curriculumUsuario', 'fechaAplicacion', 'estadoSolicitud']);
        });
    }
}
