<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('codigo');//codigo programa academico
            $table->string('nombre',500);
            $table->string('email',80)->nullable();
            $table->string('jornada',30)->nullable();
            //$table->primary('programa_codigo');
            $table->bigInteger('coordinador_id')->nullable();
            //$table->foreign('coordinador_id')->references('id')->on('users')->onUpdate('cascade');
            $table->boolean('estado');
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
        Schema::dropIfExists('programas');
    }
}
