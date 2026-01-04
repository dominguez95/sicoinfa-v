<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtrosDTE extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'otrosdte';
    protected $fillable = [
        'facturas_id',
        'usuario_id',
        'f_inicio',
        'f_fin',
        'h_inicio',
        'h_fin',
        'tipoContingencia',
        'motivoContingencia',
        'tipo',
        'estado',
        'estado_documentos',
        'json_response',
        'json_lote_fc',
        'json_lote_cf',
        'uuid',
        'paso',
        'pedidos_locales',
        'correos_enviado' // nuevo
    ];

    /**
     * Get the user that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    /**
     * Get the contingencia that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contingencia_codigo()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipoContingencia');
    }
}
