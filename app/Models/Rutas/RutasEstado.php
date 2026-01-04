<?php

namespace App\Models\Rutas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutasEstado extends Model
{
    use HasFactory;

    protected $table = "rutas_estado";
    protected $fillable = ['nombre'];
}
