<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("cronograma_id");
            $table->foreign('cronograma_id')->references('id')->on('cronogramas')->onDelete('cascade');
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean("asistencia");
            $table->unsignedBigInteger("emprendimiento_id")->nullable();
            $table->foreign('emprendimiento_id')->references('id')->on('emprendimientos')->onDelete('cascade');
            $table->integer("asesor")->nullable();
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
        Schema::dropIfExists('asistencia');
    }
}
