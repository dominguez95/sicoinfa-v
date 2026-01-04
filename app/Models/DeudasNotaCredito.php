<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeudasNotaCredito extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'deudas_notacredito';
    protected $fillable = [
        'deudas_id',
        'numero',
        'total_pago',
        'fecha_notacredito',
        'estado'
    ];
    protected $dates = ['deleted_at'];
    /**
     * ESTADO APARECE PORQUE EL DELETED_AT NO FUNCIONA AL VALIDARLO EN EL
     * LA PARTE DE LAS DEUDAS PRINCIPAL
     * 2 = BORRADO
     * 1 = ACTIVO
     */

    public function deuda()
    {
        return $this->belongsTo(Deudas::class, 'deudas_id');
    }
}
