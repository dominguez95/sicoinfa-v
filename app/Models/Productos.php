<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'stocks';
    protected $fillable = [
        'image',
        'code',
        'barcode',
        'name',
        'exempt_iva',
        'stock_min',
        'state',
        'category_det',
        'reference_det',
        'manufacturer_id',
        'category_id',
        'measures_id',
        'description',
        'slug',
        'uuid',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get all of the almacen for the Productos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function almacen()
    {
        return $this->hasMany(Almacenes::class, 'stocks_id');
    }

    public function almacen_lastest()
    {
        return $this->hasOne(Almacenes::class, 'stocks_id')->latest();
    }

    /**
     * Get the unidades that owns the Productos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidades()
    {
        return $this->belongsTo(Unidaddemedidas::class, 'measures_id');
    }

    /**
     * Get all of the detalle for the Productos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalle()
    {
        return $this->hasMany(FacturaDetalle::class, 'producto_id');
    }

    /**
     * Get the ingreso associated with the Productos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ingreso()
    {
        return $this->hasOne(Ingresos::class, 'stocks_id')->latest();
    }

    /**
     * Get the precio associated with the Productos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function precio()
    {
        return $this->hasOne(Precios::class, 'producto_id')->latest('updated_at');
    }
    /**
     * Get all of the precioventas for the Productos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function precioventas()
    {
        return $this->hasMany(PrecioVentas::class, 'producto_id');
    }

    public function precioventaUnidad()
    {
        return $this->hasOne(PrecioVentas::class, 'producto_id')->latest();
    }
    /**
     * Get the marca that owns the Productos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marca()
    {
        return $this->belongsTo(Marcas::class, 'manufacturer_id');
    }

    /**
     * Get the categoria that owns the Productos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'category_id');
    }

    public function combos_detalle()
    {
        return $this->hasOne(CombosDetalles::class, 'producto_id');
    }
    public function combos()
    {
        return $this->belongsToMany(Combos::class, 'combo_producto')
            ->whereNull('combos.deleted_at');
    }
}
