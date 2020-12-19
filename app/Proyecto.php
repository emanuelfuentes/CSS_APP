<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'idProyecto';
    protected $fillable = ['contraparte', 'cupos', 'descripcion', 'encargado', 'horario', 'nombre'];
}
