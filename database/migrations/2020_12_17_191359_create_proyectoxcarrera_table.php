<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoxcarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectoxcarrera', function (Blueprint $table) {
            $table->bigIncrements('idProyectoCarrera');
            $table->unsignedbigInteger('idProyecto')->unique();
            $table->foreign('idProyecto')->references('idProyecto')->on('proyecto')->onDelete('cascade');
            $table->unsignedbigInteger('idCarrera')->unique();
            $table->foreign('idCarrera')->references('idCarrera')->on('carrera')->onDelete('cascade');
            $table->unsignedbigInteger('idPerfil')->unique();
            $table->foreign('idPerfil')->references('idPerfil')->on('perfil')->onDelete('cascade');            
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
        Schema::dropIfExists('proyectoxcarrera');
    }
}
