<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil', function (Blueprint $table) {
            $table->increments('idPerfil');
            $table->string('perfil', 15);
            $table->string('descripcion', 50);
        });

        DB::table('perfil')
        ->insert(array('idPerfil'=>'1', 'perfil'=>'Primero', 'descripcion'=>'Primer año'));
        DB::table('perfil')
        ->insert(array('idPerfil'=>'2', 'perfil'=>'Segundo', 'descripcion'=>'Segundo año'));
        DB::table('perfil')
        ->insert(array('idPerfil'=>'3', 'perfil'=>'Tercero', 'descripcion'=>'Tercer año'));
        DB::table('perfil')
        ->insert(array('idPerfil'=>'4', 'perfil'=>'Cuarto', 'descripcion'=>'Cuarto año'));
        DB::table('perfil')
        ->insert(array('idPerfil'=>'5', 'perfil'=>'Quinto', 'descripcion'=>'Quinto año'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil');
    }
}
