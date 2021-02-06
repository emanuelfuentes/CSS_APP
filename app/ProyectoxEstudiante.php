<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoxEstudiante extends Model
{
    protected $table = 'proyectoxestudiante';
    protected $primaryKey = 'idProyectoEstudiante';
    protected $fillable = ['idProyecto', 'idUser', 'estado', 'modifiedBy'];
}