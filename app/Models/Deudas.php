<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deudas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'deudas';

    protected $fillable = [
        'user_id',
        'proveedor_id',
        'numero_factura',
        'documento_id',
        'condicionespago_id',
        'fecha_factura',
        'fecha_pago',
        'total_compra',
        'estadodeuda',
        'tipo_deuda_id'
    ];

    protected $dates = ['deleted_at'];
    /**
     * 1 -> Deuda
     * 2 -> Pagado
     */

    public function documento()
    {
        return $this->belongsTo(Documentos::class, 'documento_id');
    }
    public function condiciones_pago()
    {
        return $this->belongsTo(CondicionesPagos::class, 'condicionespago_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'proveedor_id')->withTrashed();
    }

    public function abonos()
    {
        return $this->hasMany(DeudasAbonos::class, 'deudas_id');
    }

    public function notas_creditos()
    {
        return $this->hasMany(DeudasNotaCredito::class, 'deudas_id');
    }

    public function pagos()
    {
        return $this->hasOne(DeudasPagos::class, 'deudas_id')->latest('updated_at');
    }

    public function last_abono()
    {
        return $this->hasOne(DeudasAbonos::class, 'deudas_id')->latest('updated_at');
    }

    public function last_nota()
    {
        return $this->hasOne(DeudasNotaCredito::class, 'deudas_id')->latest('updated_at');
    }


    public function total_abonos()
    {
        return $this->abonos()->sum('total_pago');
    }

    public function total_notas()
    {
        return $this->notas_creditos()->sum('total_pago');
    }

    /**
     * Get the transactions that owns the Deudas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(DeudasTransacciones::class, 'deudas_id');
    }

    public function checkAndMarkAsPaid()
    {
        // Solo para deudas a crédito (asumiendo que tienes un campo para eso)
        if ($this->estadodeuda == 2) {
            return; // No aplica
        }

        // Obtener suma de abonos + notas de crédito
        $totalPagado = $this->transactions()
            ->whereIn('tipo_transaccion_id', [1, 3])
            ->sum('total_pago');

        // Si el total pagado es igual o mayor al total de la deuda
        if ($totalPagado >= $this->total_compra) {

            // Marcar como pagada si no lo está aún
            if ($this->estadodeuda != 2) {
                $this->update(['estadodeuda' => 2]);
            }

            // Verificar si ya hay una transacción de tipo "pagado"
            $existePagado = $this->transactions()
                ->where('tipo_transaccion_id', 2)
                ->exists();

            if (!$existePagado) {
                // Tomar último abono o nota de crédito
                $ultima = $this->transactions()
                    ->whereIn('tipo_transaccion_id', [1, 3])
                    ->latest('created_at')
                    ->first();

                $this->transactions()->create([
                    'tipo_transaccion_id' => 2, // Pagado
                    'formaspago_id' => $ultima?->formaspago_id,
                    'banco_id' => $ultima?->banco_id,
                    'numero' => $ultima?->numero,
                    'numero_recibo' => $ultima?->numero_recibo,
                    'presentafactura' => $ultima?->presentafactura,
                    'total_pago' => $this->total_compra, // Informativo
                    'estado' => 1,
                    'fecha' => now(),
                ]);
            }
        }
    }
}
