<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursEspañolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours_españols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('cuidad');
           // $table->string('photo');
            $table->string('categories');
            $table->string('schedulle');
            $table->string('duration');
            $table->text('override');
            $table->text('whatsIncluded');
            $table->text('itinerary');
            $table->string('mapaGoogle');
            $table->string('puntoInicio');
            $table->number('calification')->default(5);
            $table->string('lenguajes');
            $table->string('price');
            $table->unsignedBigInteger('user_guide')->unsigned();

            $table->timestamps();
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
        Schema::dropIfExists('tours_españols');
    }
}
