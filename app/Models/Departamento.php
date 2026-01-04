<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'departamento',
        'codigo',
        'zona_id'
    ];

    /**
     * Get all of the clientes for the Departamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'departamento');
    }

    public function sucursal()
    {
        return $this->hasOne(Sucursales::class, 'departamento');
    }

    /**
     * Get all of the municipios for the Departamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'departamento_id');
    }
}
