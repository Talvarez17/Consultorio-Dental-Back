<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    protected $connection = 'mysql';
    protected $table = 'consultas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        "id",
        "idPaciente",
        "idCita",
        "nombrePaciente",
        "apellidoPaternoPaciente",
        "apellidoMaternoPaciente",
        "fecha",
        "hora",
        "prescripcion",
        "recomendaciones"
    ];

    public $timestamps = false;
}
