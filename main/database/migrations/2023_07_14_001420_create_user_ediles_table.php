<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEdilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_ediles', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion');
            $table->string('nombres');
            $table->string('email')->unique();
            $table->string('direccion');
            $table->enum('tipo_zona',['Comuna', 'Corregimineto'])->default('Comuna');
            $table->string('zona');
            $table->string('genero');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_ediles');
    }
}
