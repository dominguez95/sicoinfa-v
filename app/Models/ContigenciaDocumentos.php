<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContigenciaDocumentos extends Model
{
    use HasFactory;

    protected $table = 'contigencia_documentos';

    protected $fillable = [
        'contigencias_id',
        'documento_id'
    ];
}
