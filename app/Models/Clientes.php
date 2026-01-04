<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "clientefacturas";

    protected $fillable = [
        'nombres',
        'apellidos',
        'cliente',
        'direccion',
        'nombre_comercial',
        'razon_social',
        'giro',
        'actividad_id', // nuevo
        'nit',
        'dui',
        'email',
        'direccion_entrega',
        'telefono',
        'condicion_pago',
        'num_registro',
        'municipio',
        'departamento',
        'remision',
        'tipo_cliente',
        'state',
        'cc',
        'documento_id',
        'user_created',
        'user_updated',
        'user_deleted',
        'categoria_contribuyente_id', // nuevo
        'exento',
        'retencion_iva',
        'latitude',
        'longitude'
    ];
    /**
     * TIPOS DE CLIENTE
     * 3 = PROVEEDOR - Juridico
     * 2 = CONTRIBUYENTE - Normal
     * 1 = CLIENTE NORMAL
     * 5 = SUJETO EXCLUIDO
     */

    /**
     * Get the departamentos that owns the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'departamento',);
    }

    /**
     * Get the municipios that owns the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'municipio');
    }
    /**
     * Get the distritos that owns the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distritos()
    {
        return $this->belongsTo(Distritos::class, 'municipio');
    }


    /**
     * Get the ingreso associated with the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ingreso()
    {
        return $this->hasOne(Ingresos::class, 'clientefacturas_id');
    }
    /**
     * Get the documento that owns the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documento_name()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'documento_id');
    }

    /**
     * Get the actividad that owns the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actividad()
    {
        return $this->belongsTo(ActividadDetalle::class, 'actividad_id');
    }

    /**
     * Get all of the fse for the Clientes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fse()
    {
        return $this->hasMany(Fse::class, 'cliente_id');
    }


    public function usuarioborrados()
    {
        return $this->belongsTo(User::class, 'user_deleted');
    }

    public function categoria_contribuyentes()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'categoria_contribuyente_id');
    }

    protected $dates = ['deleted_at'];
}
