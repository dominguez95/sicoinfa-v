<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidaddemedidas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'measures';
    protected $fillable = [
        'name',
        'state',
        'unidad_dte',
        'uuid'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get all of the products for the Unidaddemedidas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Productos::class, 'measures_id', 'id');
    }

    /**
     * Get all of the precioventas for the Unidaddemedidas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function precioventas()
    {
        return $this->hasMany(PrecioVentas::class, 'unidad');
    }

    /**
     * Get all of the detalle for the Unidaddemedidas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalle()
    {
        return $this->hasMany(FacturaDetalle::class, 'unidadmedidad_id');
    }
    /**
     * Get all of the fse_detalle for the Unidaddemedidas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fse_detalle()
    {
        return $this->hasMany(FseDetalle::class, 'unidad_id');
    }

    /**
     * Get all of the combos_detalle for the Unidaddemedidas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function combos_detalles()
    {
        return $this->hasMany(CombosDetalles::class, 'unidad_id');
    }
}
