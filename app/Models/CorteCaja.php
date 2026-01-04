<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorteCaja extends Model
{
    use HasFactory;
    protected $table = 'corte_cajas';

    protected $fillable = [
        'usuario_id',
        'fecha',
        'fecha_hasta', // nuevo
        'desde',
        'hasta',
        'observacion',
        'tipo',
        'estado',
        'caja_chica'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id')->withTrashed();
    }
}
