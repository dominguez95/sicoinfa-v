<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $table = 'notas';
    protected $fillable = [
        'facturas_id',
        'bienAtitulo',
        'tipo',
        'user_id',
        'cliente_id',
        'user_id',
        'numero_control',
        'uuid',
        'tipoModelo',
        'tipoOperacion',
        'tipoContingencia',
        'motivoContin',
        'enviado',
        'json'
    ];

    /**
     * Get the cliente that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    /**
     * Get the user that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Get the bienatitulo that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bienatitulo()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'bienAtitulo');
    }

    /**
     * Get the contingencia that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contingencia_codigo()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipoContingencia');
    }
    /**
     * Get the operacion that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operacion()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipoOperacion');
    }

    /**
     * Get the modelos that owns the Nota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modelos()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'tipoModelo');
    }
}
