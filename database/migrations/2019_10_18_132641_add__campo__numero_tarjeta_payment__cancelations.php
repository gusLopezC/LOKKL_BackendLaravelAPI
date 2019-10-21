<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampoNumeroTarjetaPaymentCancelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->string('NumTarjeta');
            $table->string('EstadoDinero');
        });

        Schema::table('cancelations', function (Blueprint $table) {
            //
            $table->string('NumTarjeta');
            $table->string('EstadoDinero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
