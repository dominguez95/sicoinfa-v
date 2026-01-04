<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketsLotes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ticket_lotes';

    protected $fillable = [
        'num_caja',
        'resolucion',
        'serie_autorizada',
        'fecha_resolucion',
        'cantidad',
        'cantidad_autorizada'
    ];
    protected $dates = ['deleted_at'];

    public function factura()
    {
        return $this->hasMany(Factura::class, 'ticket_id');
    }
}
