<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $table = 'instituciones'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombreInstitucion', 'fechaCreacion', 'tipoInstitucion', 'passwordInstitucion', 'correoInstitucion', 'disposicionInstitucion',
    ];

}

