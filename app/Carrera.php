<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carrera';
    protected $primaryKey = 'idCarrera';
    protected $fillable = ['idFacultad', 'nombre'];


    public function facultad()
    {
        return $this->belongsTo('App\Facultad', 'idFacultad', 'idFacultad');
    }
}