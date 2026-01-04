<?php

namespace App\Models\Rutas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutasFacturaDetalle extends Model
{
    use HasFactory;

    protected $table = "rutas_factura_detalle";

    protected $fillable = [
        'factura_detalle_id',
        'rutas_id',
        'cantidad'
    ];
}
