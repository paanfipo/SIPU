<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipomaestroitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipomaestroitem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->integer('numitem');
            $table->text('observacion');
            $table->boolean('estado')->default(1);
            $table->unsignedBigInteger("tipomaestro_id");
            $table->integer("user_created_at")->nullable();
            $table->integer("user_updated_at")->nullable();
            $table->timestamps();

            $table->foreign('tipomaestro_id')->references('id')->on('tipomaestro')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipomaestroitem');
    }
}
