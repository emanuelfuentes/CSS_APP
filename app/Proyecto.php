<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'idProyecto';
    protected $fillable = ['contraparte', 'cupos_act', 'cupos', 'descripcion', 'encargado', 'horario', 'nombre', 'correo_encargado'];
}
