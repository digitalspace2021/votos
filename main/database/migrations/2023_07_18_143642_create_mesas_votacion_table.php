<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasVotacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas_votacion', function (Blueprint $table) {
            $table->id();
            $table->string('numero_mesa');
            $table->string('descripcion');
            $table->unsignedBigInteger('puesto_votacion');
            $table->timestamps();

            $table->foreign('puesto_votacion') 
                  ->references('id') 
                  ->on('puestos_votacion') 
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesas_votacion');
    }
}
