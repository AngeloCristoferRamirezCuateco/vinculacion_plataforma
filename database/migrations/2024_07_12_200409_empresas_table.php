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
        //Establece la creacion de la tabla en la base de datos
        Schema::create('Empresas', function (Blueprint $table) {
            //El campo id_empresa tendra como rango de 0 a 18,446,744,073,709,551,615.
            $table->bigIncrements('id_empresa');
            //Explicacion general de la estructura de esta linea: "$table" hace referencia al campo dentro de la tabla
            //a su vez "->string" hace referencia al tipo de dato de la tabla que en mysql sería "varchar", este campo 
            //tendra como limite 255 caracters por que no tiene un rango especificado.
            $table->string('nombreEmpresa');
            $table->string('tipoEmpresa');
            //Esta linea tiene como tipo de dato "Date" que es lo mismo en mysql
            $table->date('fechaCreacion');
            $table->string('areaEmpresa');
            $table->string('representanteEmpresa');
            $table->string('direccionEmpresa');
            //Este campo a diferencia de de "nombreEmpresa" tiene como limite 13 caracteres por la naturaleza del dato 
            //que contendra, ya que al tratarse de RFC solo tendra 13 caracteres
            $table->string('rfcEmpresa',13);
            $table->integer('evaluacionEmpresa');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Empresas');
    }
};
