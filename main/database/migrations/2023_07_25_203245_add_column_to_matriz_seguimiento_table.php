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
        });
    }
}
