<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_guides', function (Blueprint $table) {
            $table->bigIncrements('id');
                        
            $table->string('pais');
            $table->string('tipomoneda');
            $table->string('clabeInterbancaria');
            $table->string('numeroCuenta')->nullable();
            $table->string('RFC');
            $table->string('CURP');

            $table->timestamps();
            
            $table->unsignedBigInteger('user_id')->unsigned();
            // $table->timestamps();
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
        Schema::dropIfExists('payment_guides');
    }
}
