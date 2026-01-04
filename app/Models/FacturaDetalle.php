<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacturaDetalle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'facturas_detalles';

    protected $fillable = [
        'factura_id',
        'producto_id',
        'unidadmedidad_id',
        'cantidad',
        'descripcion',
        'precio_venta',
        'descuento',
        'resultado_descuento',
        'precio_venta_final',
        'combo_id',
        'combo_uuid'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the factura that owns the FacturaDetalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    /**
     * Get the producto that owns the FacturaDetalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }

    /**
     * Get the medida that owns the FacturaDetalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidad_medida()
    {
        return $this->belongsTo(Unidaddemedidas::class, 'unidadmedidad_id');
    }

    public function unidad_medida_precio()
    {
        return $this->belongsTo(PrecioVentas::class, 'unidadmedidad_id');
    }

    public function combos()
    {
        return $this->belongsTo(Combos::class, 'combo_id');
    }
}
