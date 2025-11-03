<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Veiculo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'placa',
        'tipo',
        'modelo',
        'transportadora_id',
        'status_acesso',
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }

    public function motoristas()
    {
        return $this->belongsToMany(Motorista::class, 'motorista_veiculo')
                    ->withPivot('data_associacao')
                    ->withTimestamps();
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }

    public function areas()
    {
        return $this->belongsToMany(AreaPatio::class, 'veiculo_area', 'veiculo_id', 'area_id')
                    ->withPivot('data_hora_ocupacao', 'data_hora_saida')
                    ->withTimestamps();
    }
}
