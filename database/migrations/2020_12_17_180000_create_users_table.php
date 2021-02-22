<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('idUser');
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('correo', 100)->unique();
            $table->boolean('estado');
            $table->string('genero', 10);

            $table->unsignedInteger('idRol');
            $table->foreign('idRol')->references('idRol')->on('rol')->onDelete('cascade');
            $table->unsignedInteger('idPerfil')->nullable();
            $table->foreign('idPerfil')->references('idPerfil')->on('perfil')->onDelete('cascade');
            $table->unsignedInteger('idCarrera')->nullable();
            $table->foreign('idCarrera')->references('idCarrera')->on('carrera')->onDelete('cascade');

            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
