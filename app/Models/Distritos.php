<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distritos extends Model
{
    use HasFactory;
    protected $table = 'distritos';
    protected $fillable = [
        'name',
        'departamento_id',
        'code',
        'municipio_id'
    ];

    /**
     * Get the municipios that owns the Distritos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'municipio');
    }
}
