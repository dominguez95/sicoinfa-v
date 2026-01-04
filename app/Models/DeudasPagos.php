<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeudasPagos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'deudas_pagos';

    protected $fillable = [
        'deudas_id',
        'presentafactura',
        'numero_recibo',
        'formapago_id',
        'numero',
        'condicionespago_id',
        'total_pago',
        'estado',
        'banco_id',
        'deuda_pago_lote_id'
    ];
    protected $dates = ['deleted_at'];

    /**
     * ESTADO APARECE PORQUE EL DELETED_AT NO FUNCIONA AL VALIDARLO EN EL
     * LA PARTE DE LAS DEUDAS PRINCIPAL
     * 2 = BORRADO
     * 1 = ACTIVO
     */
    public function deudas()
    {
        return $this->belongsTo(Deudas::class, 'deudas_id');
    }

    public function forma_pago()
    {
        return $this->belongsTo(FormasPagos::class, 'formapago_id');
    }
    public function condiciones_pago()
    {
        return $this->belongsTo(CondicionesPagos::class, 'condicionespago_id');
    }
    public function bancos()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'banco_id');
    }
}
