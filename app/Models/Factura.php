<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'factura';

    protected $fillable = [
        'nombre',
        'notaremision',
        'fecharemision',
        'anulacion_comentario',
        'condicionespagos_id',
        'usuario_id',
        'cliente_id',
        'documento',
        'direccion',
        'telefono',
        'num_dias',
        'fecha_vencimiento',
        'costo_envio',
        'descripcion_envio',
        'tipo_factura',
        'tipo_factura_original',
        'tipo_factura_dte',
        'numero_de_factura',
        'forma_pago_id',
        'cc',
        'estado',
        'motivo',
        'usuarioid_print',
        'corte',
        'numero_control',
        'uuid',
        'nota',
        'tipoModelo',
        'tipoOperacion',
        'tipoContingencia',
        'motivoContin',
        'enviado',
        'json',
        'json_invalidacion', // nuevo
        'json_error',
        'contingencia',
        'fecha_contigencia',
        'hora_contingencia',
        'reportadas_contingencia',
        'es_lote',
        'uuid_lote',
        'sucursal_id',
        'user_invalid_id',
        'es_plazo',
        'es_traslado',
        'fecha_cotizacion',
        'fecha_enviado',
        'ticket_id',
        'uuid_id', //nuevo
        'correo_enviado', //nuevo
        'exento', //nuevo
        'caja', // nuevo 2025
        'totalPago' // nuevo 2025
    ];
    protected $dates = ['deleted_at'];
    /**
     * ==== TIPOS DE FACTURA =====
     * 1 FACTURA NORMAL
     * 2 CREDITO FISCAL
     * 3 COTIZACION
     * 4 RESERVA
     * 5 TICKET
     * 6 DEVOLUCION
     * 7 ANULACION
     * 8 PEDIDO
     ** ==== ESTADO DE LA FACTURAS =====
     * 1 ACTIVO: CUANDO NO SE HA IMPRIMIDO (TAMBIEN SE PUEDE TOMAR COMO RESERVA)
     * 2 DESACTIVADO: CUANDO SE IMPRIMIO
     * 7 ANULACION
     * =============
     * motivo: CUANDO LA FACTURA PASE A UNA DEVOLUCION Y CREAR UNA NUEVA
     * ==========
     * usuarioid_print: EL EMPLEADO QUE HACE LA IMPRESION DE LA FACTURA
     * ==== CORTE  =====
     * 0 = no hay corte caja
     * 1 = hay corte caja
     **/

    /**
     * Get all of the detalle for the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function factura_detalles()
    {
        return $this->hasMany(FacturaDetalle::class, 'factura_id');
    }

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
     * Get the user_print that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_print()
    {
        return $this->belongsTo(User::class, 'usuarioid_print')->withTrashed();
    }
    /**
     * Get the user that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id')->withTrashed();
    }

    /**
     * Get the tipos_documentos that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipos_documentos()
    {
        return $this->belongsTo(TiposDocumentos::class, 'tipo_factura');
    }

    /**
     * Get the documento_original that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentos_originales()
    {
        return $this->belongsTo(TiposDocumentos::class, 'tipo_factura_dte');
    }

    /**
     * Get the formaPagos that owns the Factura
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formaPagos()
    {
        return $this->belongsTo(CatalogosDetalles::class, 'forma_pago_id');
    }

    public function condicionpago()
    {
        return $this->belongsTo(FormasPagos::class, 'condicionespagos_id');
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

    public function responses()
    {
        return $this->belongsTo(Responses::class, 'uuid', 'code_uuid');
    }

    public function sucursales()
    {
        return $this->belongsTo(Sucursales::class, 'sucursal_id', 'id');
    }

    public function caja()
    {
        return $this->belongsTo(TicketsLotes::class, 'ticket_id');
    }
}
