<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $table = 'actividades';

    protected $fillable = ['name'];

    /**
     * Get the actividad_detalle that owns the Actividad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actividad_detalle()
    {
        return $this->hasMany(ActividadDetalle::class, 'actividad_id');
    }
}
