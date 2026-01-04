<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrecioVentas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'precio_ventas';

    protected $fillable = [
        'producto_id',
        'unidad',
        'cantidad',
        'precio',
        'precio_min',
        'precio_mano_de_obra',
        'descripcion',
        'uuid'
    ];
    protected $dates = ['deleted_at'];
    /**
     * Get the unidad_medida that owns the PrecioVentas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidad_medida()
    {
        return $this->belongsTo(Unidaddemedidas::class, 'unidad');
    }
    /**
     * Get the products that owns the PrecioVentas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}
