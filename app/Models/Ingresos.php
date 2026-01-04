<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingresos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detalle_stock';

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'register_date',
        'quantity',
        'unit_price',
        'state',
        'state_price',
        'stocks_id',
        'clientefacturas_id',
        'datosingresos_id',
        'es_traslado',
        'estado',
        'observaciones',
        'cantidad_devuelta',
        'traslados_id',
        'medida', // int 0
        'uuid'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the producto that owns the Ingresos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'stocks_id');
    }

    public function precio()
    {
        return $this->belongsTo(Precios::class, 'stocks_id', 'producto_id');
    }

    public function detalle_ingreso()
    {
        return $this->hasMany(DetalleIngreso::class, 'detalle_stock_id');
    }

    /**
     * Get the cliente that owns the Ingresos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'clientefacturas_id');
    }

    /**
     * Get all of the traslados for the Ingresos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traslados()
    {
        return $this->belongsTo(Traslados::class, 'traslados_id');
    }
}
