<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsuariosEdiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_ediles', function (Blueprint $table) {
            $table->string('puesto_votacion')->nullable()->after('descripcion');
            $table->string('foto')->nullable()->after('puesto_votacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_ediles', function (Blueprint $table) {
            $table->dropColumn('puesto_votacion');
            $table->dropColumn('foto');
        });
    }
}
