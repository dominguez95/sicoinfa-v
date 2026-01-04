<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fse extends Model
{
    use HasFactory;
    protected $table = 'fse';
    protected $fillable = [
        'cliente_id',
        'vendedor_id',
        'forma_pago_id',
        'numero_control',
        'uuid',
        'tipoModelo',
        'tipoOperacion',
        'tipoContingencia',
        'motivoContin',
        'enviado',
        'json'
    ];
    /**
     * Get all of the detalle for the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fse_detalles()
    {
        return $this->hasMany(FseDetalle::class, 'fse_id');
    }
    /**
     * Get the cliente that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
    /**
     * Get the vendedor that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
    /**
     * Get the formaPagos that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formaPagos()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'forma_pago_id');
    }
    /**
     * Get the contingencia that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contingencia()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipoContingencia');
    }
    /**
     * Get the operacion that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operacion()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipoOperacion');
    }

    /**
     * Get the modelos that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modelos()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipoModelo');
    }
}
