<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Empleado extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $table = 'empleados';

    // protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'apellido', 'correo', 'telefono', 'direccion', 'id_municipio', 'id_depto'];

    protected $dates = ['deleted_at'];
}
