<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasToursCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas_tours_caches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tour')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->boolean('enviado')->default(0);

            $table->timestamps();

            $table->foreign('id_tour')->references('id')->on('tours')->onDelete('cascade');
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
        Schema::dropIfExists('visitas_tours_caches');
    }
}
