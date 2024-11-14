<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Pacientes extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pacientes';
    protected $fillable = [
        "_id",
        "nombre",
        "apellidoPaterno",
        "apellidoMaterno",
        "fechaNacimiento",
        "telefono",
        "correo",
        "contrasenia"
    ];

    public $timestamps = false;
}
