<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo
    protected $table = 'Notificaciones';

    // Definir los campos que se pueden asignar en masa
    protected $fillable = [
        'id_usuario',
    ];

    // Definir la relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
