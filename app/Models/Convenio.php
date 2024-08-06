<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;

    protected $table = 'convenios';
    protected $primaryKey = 'id_convenio';

    protected $fillable = [
        'id_usuario_emisor',
        'id_usuario_receptor',
        'documento_emisor',
        'documento_receptor',
        'convenido',
    ];

    public function emisor()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_emisor');
    }

    public function receptor()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_receptor');
    }
}
