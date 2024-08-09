<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'Solicitudes';
    protected $primaryKey = 'id_solicitud'; 

    protected $fillable = [
        'id_usuario_emisor',
        'id_usuario_remitente',
        'id_empresa_emisor',
        'documento_pdf',
        'tipoSolicitud',
        'tiempo_respuesta',
        'comentario',
        'estado',
        'fecha_respuesta',
        'prioridad',
        'categoria',
        'referencia_externa',
        'archivos',
        'id_usuario_responde',
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

    public function empresaEmisora()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa_emisor', 'id_empresa');
    }

    public function usuarioResponde()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_responde', 'id_usuario');
    }
}

