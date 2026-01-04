<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificaciones extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'notificaciones';
    protected $fillable = [
        'tipo', 'registro_id', 'comentario'
    ];
    protected $dates = ['deleted_at'];


    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('estado')->withTimestamps();
    }

    public function traslados()
    {
        return $this->belongsTo(Traslados::class, 'registro_id');
    }

    public function ingreso()
    {
        return $this->belongsTo(Ingresos::class, 'registro_id');
    }
}
