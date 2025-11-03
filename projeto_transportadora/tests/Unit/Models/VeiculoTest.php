<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Veiculo;
use App\Models\Transportadora;
use App\Models\Motorista;
use App\Models\Carga;
use App\Models\AreaPatio;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VeiculoTest extends TestCase
{
    use RefreshDatabase;

    public function test_veiculo_can_be_created(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans ABC',
            'cnpj' => '12345678901234',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test1@test.com'
        ]);

        $veiculo = Veiculo::create([
            'placa' => 'ABC1234',
            'tipo' => 'Caminhão',
            'modelo' => 'Mercedes 1620',
            'transportadora_id' => $transportadora->id,
            'status_acesso' => 'ativo'
        ]);

        $this->assertInstanceOf(Veiculo::class, $veiculo);
        $this->assertEquals('ABC1234', $veiculo->placa);
    }

    public function test_veiculo_belongs_to_transportadora(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans XYZ',
            'cnpj' => '98765432109876',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test2@test.com'
        ]);

        $veiculo = Veiculo::create([
            'placa' => 'XYZ9876',
            'tipo' => 'Van',
            'modelo' => 'Fiat Ducato',
            'transportadora_id' => $transportadora->id,
            'status_acesso' => 'ativo'
        ]);

        $this->assertInstanceOf(Transportadora::class, $veiculo->transportadora);
        $this->assertEquals('Trans XYZ', $veiculo->transportadora->razao_social);
    }

    public function test_veiculo_has_many_cargas(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans 123',
            'cnpj' => '11122233344455',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test3@test.com'
        ]);

        $veiculo = Veiculo::create([
            'placa' => 'DEF5678',
            'tipo' => 'Carreta',
            'modelo' => 'Scania R440',
            'transportadora_id' => $transportadora->id,
            'status_acesso' => 'ativo'
        ]);

        Carga::create([
            'tipo' => 'Grãos',
            'peso' => 1000.50,
            'veiculo_id' => $veiculo->id
        ]);

        $this->assertCount(1, $veiculo->cargas);
    }

    public function test_veiculo_belongs_to_many_motoristas(): void
    {
        $transportadora = Transportadora::create([
            'razao_social' => 'Trans 456',
            'cnpj' => '55566677788899',
            'endereco' => 'Rua Teste',
            'telefone' => '1199999999',
            'email' => 'test4@test.com'
        ]);

        $veiculo = Veiculo::create([
            'placa' => 'GHI9012',
            'tipo' => 'Caminhão',
            'modelo' => 'Volvo FH',
            'transportadora_id' => $transportadora->id,
            'status_acesso' => 'ativo'
        ]);

        $motorista = Motorista::create([
            'nome' => 'José Silva',
            'cpf' => '12345678901',
            'cnh' => 'ABC123',
            'telefone' => '11999999999',
            'transportadora_id' => $transportadora->id
        ]);

        $veiculo->motoristas()->attach($motorista->id, ['data_associacao' => now()]);

        $this->assertCount(1, $veiculo->motoristas);
    }
}
