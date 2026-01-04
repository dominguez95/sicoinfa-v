<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeudasRemanentes extends Model
{
    use HasFactory;
    protected $table = 'deudas_remanentes';
    protected $fillable = [
        'proveedor_id',
        'total',
        'restante',
        'estado',
    ];
}
