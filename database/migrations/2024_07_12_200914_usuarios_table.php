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
        Schema::create("Usuarios", function (Blueprint $table){
            $table->bigIncrements("id_usuario");
            $table->unsignedBigInteger("id_empresa");
            // $table->unsignedBigInteger("id_rol");
            $table->string("nombreUsuario");
            $table->string("apellidoPaterno");
            $table->string("apellidoMaterno");
            $table->string("telefonoUsuario");
            $table->string("correoUsuario");
            $table->string("passwordUsuario");
            $table->integer("evaluacionUsuario");
            $table->binary("curriculumUsuario");
            $table->timestamps();

            $table->foreign("id_empresa")->references("id_empresa")->on("Empresas")->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("Usuarios");
    }
};
