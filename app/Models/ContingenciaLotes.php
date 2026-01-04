<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContingenciaLotes extends Model
{
    use HasFactory;

    protected $table = 'contingencia_lotes';
    protected $fillable = [
        'otrosdte_id',
        'json_response',
        'json_error',
        'documento_tipo',
        'cantidad_dtes',
        'cantidad_error',
        'cantidad_success',
        'status',
        'status_verificado'
    ];
    /**
     * Get the contingencia that owns the ContingenciaLotes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contingencia()
    {
        return $this->belongsTo(Contingencias::class, 'otrosdte_id');
    }
}
