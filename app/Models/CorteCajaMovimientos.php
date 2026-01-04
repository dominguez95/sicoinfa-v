<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorteCajaMovimientos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'corte_cajas_movimientos';
    protected $fillable = [
        'corte_caja_id',
        'numero_doc',
        'proveedor_id', // no obligatorio
        'nombre',
        'comentario',
        'tipo', // salidas o entradas
        'total',
    ];
}
