<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'idProyecto';
    protected $fillable = ['contraparte', 'cupos_act', 'cupos', 'descripcion', 'encargado', 'horario', 'nombre', 'correo_encargado'];

    public function estudiantes()
    {
        return $this->belongsToMany('App\User', 'proyectoxestudiante', 'idProyecto', 'idUser' )->withPivot('estado');
    }

    public function carreras()
    {
        return $this->belongsToMany('App\Carrera', 'proyectoxcarrera', 'idProyecto', 'idCarrera')->withPivot(['limite_inf', 'limite_sup']);
    }
}
