<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMatrizSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_seguimiento', function (Blueprint $table) {
            $table->json('obs_cuatro')->nullable()->default(null);
            $table->json('obs_cinco')->nullable()->default(null);
            $table->boolean('respuesta_ocho');
            $table->boolean('respuesta_nueve');
            $table->json('fechas_nueve')->nullable()->default(null);
            $table->json('obs_nueve')->nullable()->default(null);
            $table->boolean('respuesta_diez');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_seguimiento', function (Blueprint $table) {
            $table->dropColumn('obs_cuatro');
            $table->dropColumn('obs_cinco');
            $table->dropColumn('respuesta_ocho');
            $table->dropColumn('respuesta_nueve');
            $table->dropColumn('fechas_nueve');
            $table->dropColumn('obs_nueve');
            $table->dropColumn('respuesta_diez');
            
        });
    }
}
