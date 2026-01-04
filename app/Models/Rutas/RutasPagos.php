<?php

namespace App\Models\Rutas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RutasPagos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "rutas_pagos";

    protected $fillable = [
        'rutas_id',
        'tipo_pago_id',
        'total_pago'
    ];
}
