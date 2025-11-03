<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncaoVisitante extends Model
{
    
    protected $table = "funcoes_visitantes";
    protected $fillable = ["descricao"];

    public function visitantes()
    {
        return $this->hasMany(Visitante::class, 'funcao_id');
    }
}
