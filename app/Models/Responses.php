<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responses extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'status_code',
        'status',
        'code_uuid',
        'type',
        'es_lote'
    ];
    public function factura()
    {
        return $this->hasOne(Factura::class, 'uuid', 'code_uuid');
    }
}
