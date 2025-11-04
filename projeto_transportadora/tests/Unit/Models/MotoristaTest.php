<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Motorista;
use App\Models\Transportadora;
use App\Models\Veiculo;
use App\Models\Carga;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MotoristaTest extends TestCase
{
    use RefreshDatabase;

    public function test_motorista_can_be_created(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans 789',
            'cnpj' => '99988877766655',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test5@test.com'
        ]);

        $motorista = Motorista::create([
            'nome' => 'Carlos Pereira',
            'cpf' => '98765432100',
            'cnh' => 'DEF456',
            'telefone' => '11988888888',
            'transportadora_id' => $transportadora->id
        ]);

        $this->assertInstanceOf(Motorista::class, $motorista);
        $this->assertEquals('Carlos Pereira', $motorista->nome);
    }

    public function test_motorista_belongs_to_transportadora(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans 321',
            'cnpj' => '44455566677788',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test6@test.com'
        ]);

        $motorista = Motorista::create([
            'nome' => 'Paulo Santos',
            'cpf' => '11122233344',
            'cnh' => 'GHI789',
            'telefone' => '11977777777',
            'transportadora_id' => $transportadora->id
        ]);

        $this->assertInstanceOf(Transportadora::class, $motorista->transportadora);
        $this->assertEquals('Trans 321', $motorista->transportadora->razao_social);
    }

    public function test_motorista_belongs_to_many_veiculos(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans 654',
            'cnpj' => '33322211100099',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test7@test.com'
        ]);

        $motorista = Motorista::create([
            'nome' => 'Ricardo Lima',
            'cpf' => '55566677788',
            'cnh' => 'JKL012',
            'telefone' => '11966666666',
            'transportadora_id' => $transportadora->id
        ]);

        $veiculo = Veiculo::create([
            'placa' => 'JKL3456',
            'tipo' => 'Caminhão',
            'modelo' => 'Iveco Tector',
            'transportadora_id' => $transportadora->id,
            'status_acesso' => 'ativo'
        ]);

        $motorista->veiculos()->attach($veiculo->id, ['data_associacao' => now()]);

        $this->assertCount(1, $motorista->veiculos);
    }

    public function test_motorista_has_many_cargas(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans 987',
            'cnpj' => '88877766655544',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test8@test.com'
        ]);

        $motorista = Motorista::create([
            'nome' => 'Fernando Costa',
            'cpf' => '99988877766',
            'cnh' => 'MNO345',
            'telefone' => '11955555555',
            'transportadora_id' => $transportadora->id
        ]);

        Carga::create([
            'tipo' => 'Eletrônicos',
            'peso' => 500.00,
            'motorista_id' => $motorista->id
        ]);

        $this->assertCount(1, $motorista->cargas);
    }
}
