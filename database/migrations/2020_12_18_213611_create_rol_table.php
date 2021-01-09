<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->bigIncrements('idRol');
            $table->string('nombre', 30);
            $table->string('descripcion', 100);
        });
        DB::table('rol')
        ->insert(array('idRol'=>'1', 'nombre'=>'Administrador', 'descripcion'=>'Administrador del Centro de Servicio Social CSS'));
        DB::table('rol')
        ->insert(array('idRol'=>'2', 'nombre'=>'NormalUser', 'descripcion'=>'Estudiante a impartir horas sociales'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol');
    }
}
