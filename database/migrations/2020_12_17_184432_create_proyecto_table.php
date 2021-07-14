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
            $table->tinyInteger('estado');
            $table->string('contraparte', 150);
            $table->smallInteger('cupos');
            $table->string('descripcion', 3000);
            $table->string('encargado', 150);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('horario', 100);
            $table->string('nombre', 150);
            $table->string('tipo_horas', 10);
            $table->string('correo_encargado', 100)->nullable();
            $table->string('modificado_por', 150)->nullable();
            $table->string('creado_en', 150);
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
