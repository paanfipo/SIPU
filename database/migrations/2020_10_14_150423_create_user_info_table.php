<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto')->nullable();
            $table->string('email_institucional')->nullable();
            $table->json('telefonos')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();

            $table->unsignedBigInteger("user_id");
            
            $table->JSON('encuesta')->nullable();
            
            $table->integer('tipo_documento')->nullable();
            $table->integer('numero_documento')->nullable();            
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('lugar_nacimiento')->nullable();
            $table->string('fecha_lugar_expedicion')->nullable();
            $table->JSON('libreta_militar')->nullable();
            $table->integer('nacionalidad')->nullable();
            
            $table->integer('edad')->nullable();
            $table->integer('sexo')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('estrato')->nullable();
            $table->string('barrio')->nullable();
            $table->integer('ciudad_id')->nullable();
            
            $table->integer('estado_civil')->nullable();
            $table->integer('personas_a_cargo')->nullable();
            $table->string('posicion_familiar')->nullable();
            
            $table->string('codigo_estudiante')->nullable();
            $table->integer('semestre')->nullable();
            $table->string('sede')->nullable();
            $table->integer('jornada_academica')->nullable();
            $table->string('periodo_academico')->nullable();
            $table->integer('codigo_carrera')->nullable();  
            $table->string('promedio')->nullable();

            $table->integer('etnia')->nullable();
            $table->integer('tipo_zona')->nullable();
            $table->integer('nivel_estudio')->nullable();

            $table->string('nombre_empresa')->nullable();
            $table->string('nit_empresa')->nullable();
            $table->string('file_rut')->nullable();
            $table->string('file_camara_comercio')->nullable();
            $table->string('file_representante')->nullable();          

            $table->integer('dependencia_id')->nullable();

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
        Schema::dropIfExists('user_info');
    }
}
