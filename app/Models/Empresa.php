<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Empresa extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'Empresas';

    // Atributos que son asignables en masa
    protected $fillable = [
        'nombreEmpresa',
        'tipoEmpresa',
        'fechaCreacion',
        'areaEmpresa',
        'representanteEmpresa',
        'direccionEmpresa',
        'rfcEmpresa',
        'evaluacionEmpresa',
    ];

    // Atributos que deben ser convertidos a fechas
    protected $dates = [
        'fechaCreacion',
        'created_at',
        'updated_at',
    ];

    // Relaciones (si las hay)
    // Ejemplo: Una empresa tiene muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_empresa', 'id_empresa');
    }
}
