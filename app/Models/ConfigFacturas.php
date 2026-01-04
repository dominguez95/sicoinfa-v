<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigFacturas extends Model
{
    use HasFactory;

    protected $table = 'configuracionfacturas';

    protected $fillable = [
        'dia',
        'mes',
        'anio',
        'vendedor',
        'cliente',
        'documento',
        'direccion',
        'municipio',
        'departamento',
        'giro',
        'ntaremision',
        'fechanotaremision',
        'condicionpago',
        'telefono',
        'canasta',
        'totalletras',
        'ahorro',
        'subtotal',
        'iva',
        'costoenvio',
        'totalfinal',
        'tipofactura',
        'ancho',
        'alto',
        'cc',
        'numregistro',
        'codigolocal',
        'anchodireccion',
        'anchocantidad',
        'anchoproducto',
        'anchoprecio',
        'anchosubtotal',
        'anchocliente',
        'textosjson',
    ];
}
