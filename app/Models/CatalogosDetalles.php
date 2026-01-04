<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogosDetalles extends Model
{
    use HasFactory;
    protected $table = 'catalogos_detalles';
    protected $fillable = ['codigo', 'name', 'catalogos_id'];
    /**
     * Get the catalogos that owns the CatalogosDetalles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalogos()
    {
        return $this->belongsTo(Catalogos::class, 'catalogos_id');
    }

    /**
     * Get all of the cliente for the CatalogosDetalles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cliente()
    {
        return $this->hasMany(Clientes::class, 'documento_id');
    }

    /**
     * Get all of the factura for the CatalogosDetalles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'forma_pago_id');
    }
    /**
     * Get all of the fse for the CatalogosDetalles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fse()
    {
        return $this->hasMany(Fse::class, 'forma_pago_id');
    }

    public function sucursal()
    {
        return $this->hasMany(Sucursales::class, 'tipo_establecimiento');
    }

    public function abonos()
    {
        return $this->hasMany(DeudasAbonos::class, 'banco_id');
    }
    public function pagos()
    {
        return $this->hasMany(DeudasPagos::class, 'banco_id');
    }
}
