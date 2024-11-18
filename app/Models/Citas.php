<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    protected $connection = 'mysql';
    protected $table = 'citas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        "id",
        "idPaciente",
        "nombrePaciente",
        "apellidoPaternoPaciente",
        "apellidoMaternoPaciente",
        "motivo",
        "fecha",
        "hora",
        "estado"
    ];

    public $timestamps = false;
}
