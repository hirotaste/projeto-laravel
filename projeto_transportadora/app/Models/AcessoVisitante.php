<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcessoVisitante extends Model
{
    use HasFactory;

    protected $table = 'acessos_visitantes';

    protected $fillable = [
        'visitante_id',
        'motivo_visita',
        'responsavel_interno',
        'data_hora_entrada',
        'data_hora_saida'
    ];

    protected $casts = [
        'data_hora_entrada' => 'datetime',
        'data_hora_saida' => 'datetime',
    ];

    public function visitante()
    {
        return $this->belongsTo(Visitante::class);
    }
}
