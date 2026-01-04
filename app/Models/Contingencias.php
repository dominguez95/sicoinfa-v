<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contingencias extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contingencias';
    protected $fillable = [
        'usuario_id',
        'f_inicio',
        'f_fin',
        'h_inicio',
        'h_fin',
        'tipo_contingencia_id',
        'motivo',
        'tipo',
        'estado',
        'json',
        'json_error',
        'uuid',
        'paso',
    ];
    /**
     * Get the user that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    /**
     * Get the contingencia that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contingencia_codigo()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipo_contingencia_id');
    }

    /**
     * Get all of the lote for the Contingencias
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lote()
    {
        return $this->hasMany(ContingenciaLotes::class, 'otrosdte_id');
    }
}
