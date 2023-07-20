<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_actividad');
            $table->string('descripcion_actividad');
            $table->date('fecha_actividad');
            $table->string('evidencia');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user') 
                  ->references('id') 
                  ->on('users') 
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
        Schema::dropIfExists('actividades');
    }
}
