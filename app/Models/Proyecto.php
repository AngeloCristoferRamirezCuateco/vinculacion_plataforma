<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'Proyectos';

    // Columna primaria personalizada
    protected $primaryKey = 'id_proyecto';

    // Atributos que son asignables en masa
    protected $fillable = [
        'id_convenio',
        'proposito',
        'metas',
        'alcance',
        'participantes',
    ];

    // Relación: Un proyecto pertenece a un convenio
    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'id_convenio', 'id_convenio');
    }
}
