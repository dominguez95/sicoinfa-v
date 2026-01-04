<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FseDetalle extends Model
{
    use HasFactory;
    protected $table = 'fse_detalle';
    protected $fillable = [
        'fse_id',
        'unidad_id',
        'cantidad',
        'codigo',
        'descripcion',
        'precioUni',
        'montoDescu',
        'compra',
    ];

    /**
     * Get the medida that owns the FacturaDetalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medida()
    {
        return $this->belongsTo(Unidaddemedidas::class, 'unidad_id');
    }

    /**
     * Get the factura that owns the FacturaDetalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factura()
    {
        return $this->belongsTo(Fse::class, 'fse_id');
    }
}
