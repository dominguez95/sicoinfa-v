<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeudasTiposTransacciones extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'deudas_tipo_transaccion';
    protected $fillable = ['name'];
}
