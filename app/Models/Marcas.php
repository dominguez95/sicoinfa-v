<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marcas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'manufacturers';

    protected $fillable = [
        'name',
        'state',
        'uuid'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get all of the productos for the Marcas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(Productos::class, 'manufacturer_id');
    }
}
