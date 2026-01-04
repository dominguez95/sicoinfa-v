<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CombosDetalles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'combos_detalles';
    protected $fillable = [
        'combo_id', 'producto_id', 'unidad_id', 'precio_venta', 'precio_descuento'
    ];
    protected $dates = ['deleted_at'];

    public function combos()
    {
        return $this->belongsTo(Combos::class, 'combo_id');
    }

    public function productos()
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
        return $this->belongsTo(Unidaddemedidas::class, 'unidad_id');
    }
}
