<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Visitante;
use App\Models\FuncaoVisitante;
use App\Models\AcessoVisitante;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitanteTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitante_can_be_created(): void
    {
        $visitante = Visitante::create([
            'nome' => 'João Silva',
            'documento' => '12345678900',
            'empresa' => 'Empresa ABC'
        ]);

        $this->assertInstanceOf(Visitante::class, $visitante);
        $this->assertEquals('João Silva', $visitante->nome);
        $this->assertEquals('12345678900', $visitante->documento);
    }

    public function test_visitante_has_fillable_attributes(): void
    {
        $visitante = new Visitante();
        $fillable = $visitante->getFillable();
        
        $this->assertContains('nome', $fillable);
        $this->assertContains('documento', $fillable);
        $this->assertContains('empresa', $fillable);
        $this->assertContains('funcao_id', $fillable);
    }

    public function test_visitante_belongs_to_funcao(): void
    {
        $funcao = FuncaoVisitante::create(['descricao' => 'Visitante']);
        $visitante = Visitante::create([
            'nome' => 'Maria Santos',
            'documento' => '98765432100',
            'funcao_id' => $funcao->id
        ]);

        $this->assertInstanceOf(FuncaoVisitante::class, $visitante->funcao);
        $this->assertEquals('Visitante', $visitante->funcao->descricao);
    }

    public function test_visitante_has_many_acessos(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Carlos Oliveira',
            'documento' => '11122233344'
        ]);

        AcessoVisitante::create([
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => now(),
            'motivo_visita' => 'Reunião'
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $visitante->acessos);
        $this->assertCount(1, $visitante->acessos);
    }
}
