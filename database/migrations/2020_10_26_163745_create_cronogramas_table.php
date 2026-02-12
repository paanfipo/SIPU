<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger("convocatoria_id");
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onDelete('cascade');

            $table->unsignedBigInteger("actividad_id");
            $table->foreign('actividad_id')->references('id')->on('actividades')->onDelete('cascade');
            $table->integer("etapa_id");

            $table->dateTime('fecha_hora_inicio')->nullable();
            $table->dateTime('fecha_hora_fin')->nullable();
            $table->string('duracion')->nullable();
            $table->text('observacion')->nullable();
            
            $table->unsignedBigInteger("asesor_id")->nullable();
            $table->foreign('asesor_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('enlace')->nullable();
            $table->integer("user_created_at")->nullable();
            $table->integer("user_updated_at")->nullable(); 
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
        Schema::dropIfExists('cronogramas');
    }
}
