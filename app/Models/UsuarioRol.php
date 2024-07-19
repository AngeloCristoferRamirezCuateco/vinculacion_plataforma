<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    use HasFactory;
    // Nombre de la tabla
    protected $table = 'UsuarioRoles';

    // Atributos que son asignables en masa
    protected $fillable = [
        'id_usuario',
        'id_rol',
    ];

    // Relación: Un usuario rol pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Relación: Un usuario rol pertenece a un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }
}
