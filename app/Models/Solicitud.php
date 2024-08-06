<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo
    protected $table = 'Solicitudes';
    protected $primaryKey = 'id_solicitud'; // Asegúrate de que la clave primaria sea 'id'

    // Definir los campos que se pueden asignar en masa
    protected $fillable = [
        'id_usuario_emisor',
        'id_usuario_remitente',
        'documento_pdf',
        'tipoSolicitud',
        'tiempo_respuesta',
        'comentario',
    ];

    // Definir las relaciones con otros modelos
    public function emisor()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_emisor');
    }

    public function remitente()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_remitente');
    }
}
