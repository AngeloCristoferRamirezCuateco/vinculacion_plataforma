<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model implements AuthenticatableContract
{
    use HasFactory , Authenticatable;

    // Nombre de la tabla
    protected $table = 'Usuarios';
    // Columna primaria personalizada
    protected $primaryKey = 'id_usuario';

    // Atributos que son asignables en masa
    protected $fillable = [
        'id_empresa',
        'nombreUsuario',
        'apellidoPaterno',
        'apellidoMaterno',
        'telefonoUsuario',
        'correoUsuario',
        'passwordUsuario',
        'evaluacionUsuario',
        'curriculumUsuario',
        'descripcion',
        'foto1',
        'foto2',
    ];

    // Relación: Un usuario pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }
    public function rolesUsuario()
    {
        return $this->hasMany(UsuarioRol::class, 'id_usuario', 'id_usuario');
    }
}
