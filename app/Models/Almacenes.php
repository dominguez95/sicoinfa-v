<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Almacenes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detalle_products';
    protected $fillable = [
        'stock_max',
        'stock_min',
        'quantity',
        'branch_offices_id',
        'stocks_id',
    ];

    protected $dates = ['deleted_at'];


    /**
     * Get the tienda that owns the Almacenes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'branch_offices_id');
    }

    /**
     * Get the producto that owns the Almacenes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'stocks_id');
    }
}
