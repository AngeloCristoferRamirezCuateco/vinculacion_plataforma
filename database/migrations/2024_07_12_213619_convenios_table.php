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
        Schema::create("Convenios", function (Blueprint $table) {
            $table->bigIncrements("id_convenio");
            $table->unsignedBigInteger("id_empresa_solicitante");
            $table->unsignedBigInteger("id_empresa_provedor");
            $table->date("fechaAcuerdo");
            $table->timestamps();

            $table->foreign("id_empresa_solicitante")->references("id_empresa")->on("Empresas")->onDelete("cascade");
            $table->foreign("id_empresa_provedor")->references("id_empresa")->on("Empresas")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("Convenios");
    }
};
