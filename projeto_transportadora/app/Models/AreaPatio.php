<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaPatio extends Model
{
    protected $table = "areaspatio";
    protected $fillable = [
        'nome',
        'descricao',
        'capacidade',
        'tipo',
        'status'
    ];

    protected $casts = [
        'capacidade' => 'integer',
    ];

    public function veiculos()
    {
        return $this->belongsToMany(Veiculo::class, 'veiculo_area', 'area_id', 'veiculo_id')
                    ->withPivot('data_hora_ocupacao', 'data_hora_saida')
                    ->withTimestamps();
    }
}
