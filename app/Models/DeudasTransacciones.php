<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeudasTransacciones extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'deudas_transacciones';
    protected $fillable = [
        'deudas_id',
        'presentafactura',
        'numero',
        'numero_recibo',
        'tipo_transaccion_id',
        'formaspago_id',
        'condicionespago_id',
        'banco_id',
        'total_pago',
        'estado',
        'fecha'
    ];

    /**
     * Get all of the deuda for the DeudasTransacciones
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deuda()
    {
        return $this->belongsTo(Deudas::class, 'deudas_id');
    }
}
