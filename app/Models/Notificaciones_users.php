<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones_users extends Model
{
    use HasFactory;

    protected $table = 'notificaciones_user';

    protected $fillable = [
        'id', 'notificaciones_id', 'user_id', 'estado',
    ];

    public function notificaciones()
    {
        return $this->belongsTo(Notificaciones::class);
    }
}
