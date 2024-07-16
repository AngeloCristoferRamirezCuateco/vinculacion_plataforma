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
        Schema::create("UsuarioRoles", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_usuario");
            $table->unsignedBigInteger("id_rol");
            $table->timestamps();

            $table->foreign("id_usuario")->references("id_usuario")->on("Usuarios")->onDelete("cascade");
            $table->foreign("id_rol")->references("id_rol")->on("Roles")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("UsuarioRoles");
    }
};
