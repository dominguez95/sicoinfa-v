<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    use HasFactory;

    protected $table = 'precios';
    protected $fillable = [
        'producto_id',
        'costosiniva',
        'costoconiva',
        'ganancia',
        'porcentaje',
        'precioventa',
        'precio_min',
        'cambio',
    ];

    /**
     * Get the producto that owns the Precios
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }

    public function ingreso()
    {
        return $this->hasMany(Ingresos::class, 'stocks_id', 'producto_id');
    }
}
