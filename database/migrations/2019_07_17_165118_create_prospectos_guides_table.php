<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectosGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospectos_guides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('edad');
            $table->string('cuidad_origin');
            $table->string('eres_guia');
            $table->string('trabajas_como_guia');
            $table->string('certificacion_guia');
            $table->string('idiomas_quemanejas');
            $table->string('certificacion_idiomas');
            $table->string('como_nos_conociste');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospectos_guides');
    }
}
