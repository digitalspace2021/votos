<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMatrizSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_seguimiento', function (Blueprint $table) {
            $table->boolean('respuesta_siete');
            $table->json('fechas_siete')->nullable()->default(NULL);
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
            $table->dropColumn('respuesta_siete');
            $table->dropColumn('fechas_siete');

        });
    }

}