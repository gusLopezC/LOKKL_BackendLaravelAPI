<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('cuidad');
            $table->string('pais');
            $table->string('CP');
            $table->string('categories');
            $table->longText('schedulle');
            $table->string('duration');
            $table->longText('whatsIncluded');
            $table->longText('itinerary');
            $table->string('mapaGoogle');
            $table->string('puntoInicio');
            $table->integer('calification')->default(5);
            $table->string('lenguajes');
            $table->string('price');
            $table->string('moneda');
            $table->string('verificado')->default('No');

            $table->unsignedBigInteger('user_guide')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('user_guide')->references('id')->on('guias')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
