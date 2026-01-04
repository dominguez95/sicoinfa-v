<?php

namespace App\Models\Rutas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Rutas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "rutas";
    protected $fillable = [
        'factura_id',
        'motorista_id',
        'fecha_entrega',
        'direccion',
        'latitude',
        'longitude',
        'ruta_estado_id',
        'orden',
        'total_compra'
    ];
}
