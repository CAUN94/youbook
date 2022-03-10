<?php

namespace App\Models;

use App\Models\UserMedilink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMedilink extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre',
        'Apellidos',
        'Fecha_Creacion',
        'Ultima_Cita',
        'RUT',
        'Nacimiento',
        'Celular',
        'Ciudad',
        'Comuna',
        'Direccion',
        'Email',
        'Observaciones',
        'Sexo',
        'Convenio'
    ];

    public static function last_register()
    {
        return UserMedilink::max('updated_at');
    }
}
