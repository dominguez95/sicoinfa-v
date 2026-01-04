<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogos extends Model
{
    use HasFactory;
    protected $table = 'catalogos';

    protected $fillable = ['name'];

    /**
     * Get all of the catalogos_detalle for the Catalogos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function catalogos_detalle()
    {
        return $this->hasMany(CatalogosDetalles::class, 'catalogos_id');
    }
}
