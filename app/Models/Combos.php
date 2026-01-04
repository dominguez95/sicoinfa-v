<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'combos';
    protected $fillable = [
        'name', 'desde', 'hasta', 'estado'
    ];
    protected $dates = ['deleted_at'];

    public function combo_detalles()
    {
        return $this->hasMany(CombosDetalles::class, 'combo_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'combo_producto');
    }

    public function factura_detalle()
    {
        return $this->hasMany(FacturaDetalle::class, 'combo_id');
    }
}
