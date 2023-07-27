<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaPreFormularios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_formularios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propietario_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->nullable();
            $table->string('telefono');
            $table->string('genero');
            $table->string('direccion')->nullable();
            $table->string('zona');
            $table->string('puesto_votacion')->nullable();
            $table->text('mensaje')->nullable();
            $table->string('tipo_zona')->nullable();
            $table->unsignedBigInteger('candidato_id');
            $table->string('identificacion');
            $table->string('vinculo')->nullable();
            $table->boolean('estado')->default(true);
            $table->string('mesa')->nullable();
            $table->timestamps();

            $table->foreign('propietario_id')
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
        Schema::dropIfExists('formularios');
    }
}
