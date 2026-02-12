<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('nombre_empresa_dependencia')->nullable();
             $table->string('nombre_oferta')->nullable();
             $table->string('cargo')->nullable();
             $table->text('funciones')->nullable(); 
             $table->integer("tipo_contrato")->nullable();
             $table->integer("tipo_oferta")->nullable();
             $table->double("salario")->nullable();
             $table->integer("duracion_meses")->nullable();
             $table->integer("cantidad")->nullable();
             $table->timestamp('fecha_cierre_vacante')->nullable();
             $table->integer("dependencia_id")->nullable();
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
        Schema::dropIfExists('ofertas');
    }
}
