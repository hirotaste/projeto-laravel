<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'documento',
        'empresa',
        'funcao_id'
    ];

    public function funcao()
    {
        return $this->belongsTo(FuncaoVisitante::class, 'funcao_id');
    }

    public function acessos()
    {
        return $this->hasMany(AcessoVisitante::class);
    }
}
