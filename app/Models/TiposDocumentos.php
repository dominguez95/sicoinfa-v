<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposDocumentos extends Model
{
    use HasFactory;
    protected $table = 'tipos_documentos';
    protected $fillable = ['name', 'name_dte', 'code_dte'];

    /**
     * Get all of the factura for the TiposDocumentos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function factura()
    {
        return $this->hasMany(Factura::class, 'tipo_factura');
    }
}
