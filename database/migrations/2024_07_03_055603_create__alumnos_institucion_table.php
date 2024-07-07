<?php

// database/migrations/xxxx_xx_xx_create_alumnos_institucion_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosInstitucionTable extends Migration
{
    public function up()
    {
        Schema::create('alumnos_institucion', function (Blueprint $table) {
            $table->unsignedBigInteger('idUsuario')->primary();
            $table->unsignedBigInteger('idInstitucion');
            $table->string('rolUsuario', 100);
            $table->integer('esAdmin')->default(0);
            $table->timestamps();

            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios_institucion')->onDelete('cascade');
            $table->foreign('idInstitucion')->references('idInstitucion')->on('instituciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alumnos_institucion');
    }
}
