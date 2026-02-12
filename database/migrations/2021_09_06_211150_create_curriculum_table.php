<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->JSON('bachillerato')->nullable();
            $table->JSON('educacion_superior')->nullable();
            $table->JSON('capacitaciones')->nullable();
            $table->string('sistemas')->nullable();
            $table->JSON('idiomas')->nullable();
            $table->JSON('experiencia_laboral')->nullable();
            $table->text('perfil_ocupacional')->nullable();
            $table->JSON('referencias_personales')->nullable();
            $table->JSON('referencias_profesionales')->nullable();
            $table->JSON('horario_disponibilidad')->nullable();

            $table->string('cedula')->nullable();
            $table->string('tabulado')->nullable();
            $table->string('confidencialidad')->nullable();
            $table->string('recibo_pago')->nullable();
            $table->string('certificacion_bancaria')->nullable();
            
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
        Schema::dropIfExists('curriculum');
    }
}
