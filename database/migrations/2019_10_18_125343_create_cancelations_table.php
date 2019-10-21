<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_nr');
            $table->string('ModoPago');
            $table->string('Monto');
            $table->string('Moneda');
            $table->date('Fechareserva');
            $table->date('FechaCancelacion');
            $table->string('Estado');
            $table->string('Cancela');
            $table->string('motivoCancelacion')->nullable();
            $table->unsignedBigInteger('id_payments')->unsigned();
            $table->unsignedBigInteger('id_tour')->unsigned();
            $table->unsignedBigInteger('id_comprador')->unsigned();
            $table->unsignedBigInteger('id_guia')->unsigned();
            $table->timestamps();
            $table->foreign('id_payments')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('id_tour')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('id_comprador')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_guia')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancelations');
    }
}
