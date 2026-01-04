<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeudasAbonos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'deudas_abonos';

    protected $fillable = [
        'deudas_id',
        'total_pago',
        'numero_recibo',
        'documento_id',
        'numero',
        'condicionespago_id',
        'fecha_abono',
        'formapago_id',
        'estado',
        'banco_id'
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
    public function forma_pago()
    {
        return $this->belongsTo(FormasPagos::class, 'formapago_id');
    }
    public function condiciones_pago()
    {
        return $this->belongsTo(CondicionesPagos::class, 'condicionespago_id');
    }
    public function documento()
    {
        return $this->belongsTo(Documentos::class, 'documento_id');
    }

    public function bancos()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'banco_id');
    }
}
