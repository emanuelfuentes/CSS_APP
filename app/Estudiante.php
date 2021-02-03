<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'idEstudiante';
    protected $fillable = ['nombres', 'apellidos', 'carnet', 'correo', 'password', 'genero'];
    //protected $hidden = ['password']; Comentado por que no se si es necesario
}
