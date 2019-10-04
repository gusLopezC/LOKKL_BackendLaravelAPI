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
            $table->string('TipoProspecto');
            $table->string('nameContacto');
            $table->string('emailContacto');
            $table->string('telefonoContacto');
            $table->string('edad')->nullable();
            $table->string('ciudad');
            $table->string('preguntasGuia')->nullable();
            $table->string('comoNosConociste')->nullable();
            $table->string('document_identificacion')->nullable();
            $table->string('document_comprobantedomicilio')->nullable();
            $table->string('document_cedulafiscal')->nullable();
            $table->string('document_certificacion')->nullable();
            $table->string('estado');
            // ====================
            $table->string('nameempresa')->nullable();
            $table->string('nombreempresaLegal')->nullable();
            $table->string('sitioweb')->nullable();
            $table->string('DireccionCompletaEmpresa')->nullable();
            $table->string('ContactoCompletoEmpresa')->nullable();
            
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
        Schema::dropIfExists('prospectos_guides');
    }
}


