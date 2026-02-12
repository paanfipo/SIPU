<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprendimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprendimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nombre');
            $table->text('descripcion')->nullable();
            $table->JSON('modelo_negocio')->nullable();
            $table->unsignedBigInteger("user_id");

            $table->integer("ciudad_id")->nullable();
            $table->integer("integrantes_hombres")->nullable();
            $table->integer("integrantes_mujeres")->nullable();
            $table->integer("sector_economico")->nullable();
            $table->text('producto_servicio')->nullable();
            $table->integer("fase_emprendimiento")->nullable();

            
            $table->boolean('camara_comercio')->default(false);
            $table->integer("tipo_empresa")->nullable();
            $table->integer("ruta_empresarial")->nullable();
            
            $table->JSON("tipo_ruta_modulo")->nullable();
            $table->integer("tipo_ruta_acompañamiento")->nullable();

            $table->integer("user_created_at")->nullable();
            $table->integer("user_updated_at")->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprendimientos');
    }
}
