<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoxCarrera extends Model
{
    protected $table = 'proyectoxcarrera';
    protected $primaryKey = 'idProyectoCarrera';
    protected $fillable = ['idProyecto', 'idCarrera', 'limite_inf', 'limite_sup'];
}