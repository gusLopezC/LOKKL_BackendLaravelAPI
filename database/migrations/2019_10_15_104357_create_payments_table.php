<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_nr');
            $table->string('ModoPago');
            $table->string('IdPago');
            $table->longText('DatosComprador');
            $table->string('NameTour');

            $table->string('Monto');
            $table->string('Moneda');
            $table->string('Fechareserva');
            $table->integer('CantidadTuristas');
            $table->string('status')->default('Pendiente');

            $table->unsignedBigInteger('id_tour')->unsigned();
            $table->unsignedBigInteger('id_comprador')->unsigned();
            $table->unsignedBigInteger('id_guia')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('payments');
    }
}
