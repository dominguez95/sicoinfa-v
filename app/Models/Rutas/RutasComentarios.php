<?php

namespace App\Models\Rutas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RutasComentarios extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "rutas_comentarios";

    protected $fillable = [
        'rutas_id',
        'comentario'
    ];
}
