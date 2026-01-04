<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaFormaPago extends Model
{
    use HasFactory;
    protected $table = 'factura_formapago';

    protected $fillable = [
        'name',
        'tipo'
    ];
}
