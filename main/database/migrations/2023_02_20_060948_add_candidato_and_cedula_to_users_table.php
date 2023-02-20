<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCandidatoAndCedulaToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formularios', function (Blueprint $table) {
            $table->unsignedBigInteger('candidato_id');
            $table->string('identificacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formularios', function (Blueprint $table) {
            $table->dropColumn('identificacion');
            $table->dropColumn('candidato_id');
        });
    }
}
