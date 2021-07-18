<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->increments('idProyecto');
            $table->string('nombre', 300);
            $table->tinyInteger('estado');
            $table->string('contraparte', 300);
            $table->smallInteger('cupos_act');
            $table->smallInteger('cupos');
            $table->string('descripcion', 2000);
            $table->string('encargado', 150);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('horario', 300);
            $table->string('tipo_horas', 10);
            $table->string('correo_encargado', 100);
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
        Schema::dropIfExists('proyecto');
    }
}
