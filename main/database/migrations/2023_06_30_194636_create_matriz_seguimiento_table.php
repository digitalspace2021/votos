<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_seguimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_id');
            
            $table->boolean('respuesta_uno');
            
            $table->boolean('respuesta_dos');
            
            $table->boolean('respuesta_tres');
            
            $table->boolean('respuesta_cuatro');
            $table->json('fechas_cuatro')->default(NULL);
            
            $table->boolean('respuesta_cinco');
            $table->json('fechas_cinco')->default(NULL);
          
            $table->boolean('respuesta_seis');

            $table->timestamps();

            $table->foreign('formulario_id') 
                  ->references('id') 
                  ->on('formularios') 
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
        Schema::dropIfExists('matriz_seguimiento');
    }
}
