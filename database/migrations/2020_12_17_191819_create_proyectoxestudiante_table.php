<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoxestudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectoxestudiante', function (Blueprint $table) {
            $table->increments('idProyectoEstudiante');
            $table->tinyInteger('estado');
            $table->string('modificado_por', 100);
            $table->timestamps();

            $table->unsignedInteger('idProyecto');
            $table->foreign('idProyecto')->references('idProyecto')->on('proyecto')->onDelete('cascade');
            $table->unsignedInteger('idUser');
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectoxestudiante');
    }
}
