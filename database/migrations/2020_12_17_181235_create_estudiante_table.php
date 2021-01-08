<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->bigIncrements('idEstudiante');
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('carnet', 100)->unique();
            $table->string('correo', 150)->unique();
            $table->tinyInteger('estado');
            $table->string('genero', 100);
            $table->string('default_password', 100);
            $table->string('password', 100);
            $table->unsignedbigInteger('idPerfil');
            $table->foreign('idPerfil')->references('idPerfil')->on('perfil')->onDelete('cascade');
            $table->unsignedbigInteger('idCarrera');
            $table->foreign('idCarrera')->references('idCarrera')->on('carrera')->onDelete('cascade');
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
        Schema::dropIfExists('estudiante');
    }
}
