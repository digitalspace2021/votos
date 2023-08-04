<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formularios', function (Blueprint $table) {
            $table->string('vinculo')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('foto')->nullable();
            $table->string ('mesa')->nullable();
            $table->date('fecha_nacimiento')->nullable();

            $table->unsignedBigInteger('candidato_id')->nullable()->change();
            $table->string('zona')->nullable()->change();
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
            $table->dropColumn('vinculo');
            $table->dropColumn('estado');
            $table->dropColumn('foto');
            $table->dropColumn('mesa');
            $table->dropColumn('fecha_nacimiento');

            $table->unsignedBigInteger('candidato_id')->change();
            $table->string('zona')->change();
        });
    }
}
