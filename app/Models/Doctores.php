<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Doctores extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'doctores';
    protected $fillable = [
        "_id",
        "nombre",
        "apellidoPaterno",
        "apellidoMaterno",
        "correo",
        "contrasenia"
    ];

    public $timestamps = false;
}
