<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TipoGuia');
            $table->string('name');
            $table->string('email');
            $table->string('telefono');
            $table->string('edad');
            $table->string('ciudad');
            $table->string('document_identificacion');
            $table->string('document_comprobantedomicilio');
            $table->string('document_cedulafiscal');
            $table->string('document_certificacion');
            $table->unsignedBigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('guias');
    }
}
