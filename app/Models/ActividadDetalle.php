<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadDetalle extends Model
{
    use HasFactory;
    protected $table = 'actividad_detalles';
    protected $fillable = ['name', 'code', 'actividad_id'];
    /**
     * Get all of the actividad for the ActividadDetalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }


    /**
     * Get all of the cliente for the ActividadDetalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cliente()
    {
        return $this->hasMany(Clientes::class, 'actividad_id');
    }
}
