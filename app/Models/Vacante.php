<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'Vacantes';

    // Columna primaria personalizada
    protected $primaryKey = 'id_vacante';

    // Atributos que son asignables en masa
    protected $fillable = [
        'id_empresa',
        'proyectoDisponible',
        'numeroVacantes',
        'datosVacante',
        'estadoVacante',
    ];

    // Relación: Una vacante pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }
}
