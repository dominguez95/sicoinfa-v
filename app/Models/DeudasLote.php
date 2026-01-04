<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeudasLote extends Model
{
    use HasFactory;
    protected $table = 'deudas_lote';
    protected $fillable = [
        'descripcion',
        'monto_entregado',
        'saldo_a_favor',
        'details'
    ];


    /**
     * The deudas that belong to the DeudasPagosLote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function deudas()
    {
        return $this->belongsToMany(Deudas::class, 'deudas_lote_detalle');
    }
}
