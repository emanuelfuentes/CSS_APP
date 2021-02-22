<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultad', function (Blueprint $table) {
            $table->bigIncrements('idFacultad');
            $table->string('nombre', 50);
        });

        DB::table('facultad')
        ->insert(array('idFacultad'=>'1', 'nombre'=>'Ingeniería y arquitectura'));
        DB::table('facultad')
        ->insert(array('idFacultad'=>'2', 'nombre'=>'Ciencias sociales y humanidades'));
        DB::table('facultad')
        ->insert(array('idFacultad'=>'3', 'nombre'=>'Ciencias económicas y empresariales'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facultad');
    }
}
