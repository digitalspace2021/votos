<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ediles', function (Blueprint $table) {
            $table->id();
            $table->boolean('concejo')->default(false);
            $table->boolean('alcaldia')->default(false);
            $table->boolean('gobernacion')->default(false);
            $table->unsignedBigInteger('edil_id');
            $table->unsignedBigInteger('formulario_id');

            $table->foreign('edil_id')
                ->references('id')
                ->on('usuarios_ediles')
                ->onDelete('cascade');
            
            $table->foreign('formulario_id')
                ->references('id')
                ->on('formularios')
                ->onDelete('cascade');

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
        Schema::dropIfExists('ediles');
    }
}
