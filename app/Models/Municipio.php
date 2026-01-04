<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    protected $fillable = [
        'code',
        'municipio',
        'departamento_id'
    ];

    /**
     * Get all of the clientes for the Municipio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'municipio');
    }

    public function sucursal()
    {
        return $this->hasMany(Sucursales::class, 'municipio');
    }

    /**
     * Get the departamento that owns the Municipio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depto()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    /**
     * Get all of the distritos for the Municipio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distritos()
    {
        return $this->hasMany(Distritos::class, 'municipio_id');
    }
}
