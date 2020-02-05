<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes_chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('mensaje')->nullable();
            $table->string('escribio')->nullable();
            $table->unsignedBigInteger('id_reservacion')->unsigned();
            $table->unsignedBigInteger('id_comprador')->unsigned();
            $table->unsignedBigInteger('id_guia')->unsigned();

            $table->timestamps();
            
            $table->foreign('id_reservacion')->references('id')->on('payments')->onDelete('cascade');
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
        Schema::dropIfExists('mensajes_chats');
    }
}
