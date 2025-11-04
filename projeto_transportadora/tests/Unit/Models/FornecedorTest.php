<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;

    public function test_fornecedor_can_be_created(): void
    {
        $fornecedor = Fornecedor::create([
            'razao_social' => 'Fornecedor XYZ Ltda',
            'cnpj' => '12345678901234',
            'responsavel' => 'Roberto Silva'
        ]);

        $this->assertInstanceOf(Fornecedor::class, $fornecedor);
        $this->assertEquals('Fornecedor XYZ Ltda', $fornecedor->razao_social);
        $this->assertEquals('12345678901234', $fornecedor->cnpj);
    }

    public function test_fornecedor_has_fillable_attributes(): void
    {
        $fornecedor = new Fornecedor();
        $fillable = $fornecedor->getFillable();
        
        $this->assertContains('razao_social', $fillable);
        $this->assertContains('cnpj', $fillable);
        $this->assertContains('responsavel', $fillable);
    }

    public function test_fornecedor_cnpj_is_unique(): void
    {
        Fornecedor::create([
            'razao_social' => 'Empresa A',
            'cnpj' => '11111111111111'
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);
        
        Fornecedor::create([
            'razao_social' => 'Empresa B',
            'cnpj' => '11111111111111'
        ]);
    }
}
