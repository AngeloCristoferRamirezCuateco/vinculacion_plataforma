<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string("nombreUsuario");
            $table->string("apellidoPaterno");
            $table->string("apellidoMaterno")->nullable();
            $table->string("telefonoUsuario");
            $table->string("correoUsuario");
            $table->string("passwordUsuario");
            $table->integer("evaluacionUsuario")->nullable();
            $table->binary("curriculumUsuario")->nullable(); // Esto se cambiará a LONGBLOB
            $table->text("descripcion")->nullable(); 
            $table->binary("foto1")->nullable(); // Esto se cambiará a LONGBLOB
            $table->binary("foto2")->nullable(); // Esto se cambiará a LONGBLOB
            $table->timestamps();

            $table->foreign("id_empresa")->references("id_empresa")->on("Empresas")->onDelete('cascade');
        });

        // Modificar columnas a LONGBLOB
        DB::statement('ALTER TABLE `Usuarios` MODIFY COLUMN `curriculumUsuario` LONGBLOB');
        DB::statement('ALTER TABLE `Usuarios` MODIFY COLUMN `foto1` LONGBLOB');
        DB::statement('ALTER TABLE `Usuarios` MODIFY COLUMN `foto2` LONGBLOB');
    }


    public function down()
    {
        Schema::dropIfExists("Usuarios");
    }
};
