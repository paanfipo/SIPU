<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriaEtapaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatoria_etapa_user', function (Blueprint $table) {            
            $table->unsignedBigInteger("convocatoria_id");
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onDelete('cascade');
            $table->unsignedBigInteger("etapa_id");
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade');
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer("emprendimiento")->nullable();
            $table->boolean("finalizado");
            $table->boolean("caracterizacion")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convocatoria_etapa_user');
    }
}
