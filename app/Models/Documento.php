<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo
    protected $table = 'Documentos';

    // Definir los campos que se pueden asignar en masa
    protected $fillable = [
        'id_usuario',
        'nombreDocumento',
        'tipoDocumento',
        'fechaCreacion',
    ];

    // Definir la relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
