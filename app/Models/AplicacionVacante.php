<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicacionVacante extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'AplicacionVacante';

    // Columna primaria personalizada
    protected $primaryKey = 'id_aplicante';

    // Atributos que son asignables en masa
    protected $fillable = [
        'id_usuario',
        'id_vacante',
    ];

    // Relación: Una aplicación de vacante pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Relación: Una aplicación de vacante pertenece a una vacante
    public function vacante()
    {
        return $this->belongsTo(Vacante::class, 'id_vacante', 'id_vacante');
    }
}
