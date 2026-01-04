<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traslados extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'traslados';

    protected $fillable = [
        'user_id',
        'sucursales',
        'estado',
        'num_traslado'
    ];
}
