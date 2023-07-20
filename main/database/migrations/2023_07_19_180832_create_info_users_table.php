<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_users', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('genero');
            $table->string('tipo_zona');
            $table->integer('zona');
            $table->unsignedBigInteger('referido_id');
            $table->timestamps();

            $table->foreign('referido_id') 
                  ->references('id') 
                  ->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_users');
    }
}
