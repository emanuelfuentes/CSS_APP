<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'idAdmin';
    protected $fillable = ['nombres', 'apellidos', 'correo', 'password'];
    //protected $hidden = ['password']; Comentado por que no se si es necesario
}
