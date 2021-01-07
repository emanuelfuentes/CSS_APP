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
            $table->bigIncrements('idProyectoEstudiante');
            $table->unsignedbigInteger('idProyecto');
            $table->foreign('idProyecto')->references('idProyecto')->on('proyecto')->onDelete('cascade');
            $table->unsignedbigInteger('idEstudiante');
            $table->foreign('idEstudiante')->references('idEstudiante')->on('estudiante')->onDelete('cascade');
            $table->string('appliedAt', 150);
            $table->tinyInteger('estado');
            $table->string('modifiedBy', 150);
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
        Schema::dropIfExists('proyectoxestudiante');
    }
}
