<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioInstitucion extends Model
{
    use HasFactory;

    protected $table = 'usuarios_institucion';
    protected $primaryKey = 'idUsuario'; // Clave primaria personalizada
    public $incrementing = true; // Si la clave primaria es auto-incremental
    protected $keyType = 'int'; // Tipo de la clave primaria

    protected $fillable = [
        'nombreUsuario',
        'apellidoMaterno',
        'apellidoPaterno',
        'correoUsuario',
        'passwordUsuario',
        'idInstitucion',
        'rolUsuario',
        'esAdmin',
        'fechaCreacionCuenta'
    ];
}