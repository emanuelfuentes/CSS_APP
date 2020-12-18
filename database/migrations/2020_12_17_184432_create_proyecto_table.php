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
            $table->bigIncrements('idProyecto');
            $table->tinyInteger('estado');
            $table->string('contraparte', 150);
            $table->smallInteger('cupos');
            $table->string('descripcion', 600);
            $table->string('encargado', 150);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('horario', 100)->nullable()->default('text');
            $table->string('nombre', 150);
            $table->string('tipo_horas', 100)->nullable()->default('text');
            $table->string('modifiedBy', 150);
            $table->string('createdAt', 150);
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
