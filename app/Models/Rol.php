<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'Roles';

    // Columna primaria personalizada
    protected $primaryKey = 'id_rol';

    // Atributos que son asignables en masa
    protected $fillable = [
        'rol',
        'nombreRol',
    ];
}
