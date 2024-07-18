<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'Convenios';

    // Columna primaria personalizada
    protected $primaryKey = 'id_convenio';

    // Atributos que son asignables en masa
    protected $fillable = [
        'id_empresa_solicitante',
        'id_empresa_provedor',
        'fechaAcuerdo',
    ];

    // Relación: Convenio pertenece a una empresa solicitante
    public function empresaSolicitante()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa_solicitante', 'id_empresa');
    }

    // Relación: Convenio pertenece a una empresa provedora
    public function empresaProvedora()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa_provedor', 'id_empresa');
    }
}
