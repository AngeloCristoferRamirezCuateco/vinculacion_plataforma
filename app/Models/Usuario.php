<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'Usuarios';

    // Atributos que son asignables en masa
    protected $fillable = [
        'id_empresa',
        'nombreUsuario',
        'apellidoPaterno',
        'apellidoMaterno',
        'telefonoUsuario',
        'correoUsuario',
        'evaluacionUsuario',
        'curriculumUsuario',
    ];

    // Relación: Un usuario pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }
}
