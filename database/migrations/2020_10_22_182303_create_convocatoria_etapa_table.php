<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriaEtapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatoria_etapa', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->unsignedBigInteger("convocatoria_id");
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onDelete('cascade');
            $table->unsignedBigInteger("etapa_id");
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade');
            $table->integer("posicion");
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convocatoria_etapa');
    }
}
