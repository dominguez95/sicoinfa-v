<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'state',
        'uuid'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the productos that owns the Categorias
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productos()
    {
        return $this->belongsTo(Productos::class, 'category_id');
    }
}
