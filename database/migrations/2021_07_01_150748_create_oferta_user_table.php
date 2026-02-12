<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oferta_user', function (Blueprint $table) {
            $table->unsignedBigInteger("oferta_id");
            $table->foreign('oferta_id')->references('id')->on('ofertas')->onDelete('cascade');
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean("estado")->default(true);
            $table->integer("fase")->default(1);
            $table->primary(['oferta_id', 'user_id']);
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
        Schema::dropIfExists('oferta_user');
    }
}
