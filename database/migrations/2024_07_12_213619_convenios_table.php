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
            $table->foreignId('id_usuario_emisor')->constrained('Usuario')->onDelete('cascade');
            $table->foreignId('id_usuario_receptor')->constrained('Usuario')->onDelete('cascade');
            $table->string('documento_emisor')->nullable();
            $table->string('documento_receptor')->nullable();
            $table->boolean('convenido')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("Convenios");
    }
};
