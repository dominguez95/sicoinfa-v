<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursales extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'branch_offices';
    protected $fillable = [
        'name',
        'phone',
        'address',
        'state',
        'tipo_establecimiento',
        'nit',
        'nrc',
        'nombre',
        'nombre_comercial',
        'email',
        'actividad',
        'departamento',
        'municipio',
        'codigo_empresa',
        'cajas',
        'cajas_habilitadas',
        'telefonos'
    ];
    protected $dates = ['deleted_at'];

    /**
     * Get all of the almacen for the Sucursales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function almacen()
    {
        return $this->hasMany(Almacenes::class, 'branch_offices_id');
    }

    /**
     * Get all of the producto for the Almacenes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function producto()
    {
        return $this->hasManyThrough(Productos::class, Almacenes::class,);
    }

    public function establecimiento()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipo_establecimiento');
    }

    public function actividades()
    {
        return $this->belongsTo(ActividadDetalle::class, 'actividad');
    }
    /**
     * Get the departamentos that owns the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'departamento');
    }

    /**
     * Get the distritos that owns the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distritos()
    {
        return $this->belongsTo(Distritos::class, 'municipio');
    }

    public function factura()
    {
        return $this->hasMany(Factura::class, 'sucursal_id', 'id');
    }
}
