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
            $table->tinyInteger('verificado');

            $table->unsignedInteger('idRol');
            $table->foreign('idRol')->references('idRol')->on('rol')->onDelete('cascade');
            $table->unsignedInteger('idPerfil')->nullable();
            $table->foreign('idPerfil')->references('idPerfil')->on('perfil')->onDelete('cascade');
            $table->unsignedInteger('idCarrera')->nullable();
            $table->foreign('idCarrera')->references('idCarrera')->on('carrera')->onDelete('cascade');

            $table->string('ultima_fecha_contra', 10);
            $table->string('ya_aplico_hoy', 10)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')
        ->insert(array('idUser'=>'1','nombres'=>'Oscar','apellidos'=>'Arias','correo'=>'admin@uca.edu.sv','estado'=>'1','genero'=>'M','verificado'=>'1',
                'idRol'=>'1','ultima_fecha_contra'=>'1-1-2021', 'password'=>bcrypt('temporal')));
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
