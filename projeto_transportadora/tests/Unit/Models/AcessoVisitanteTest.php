<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\AcessoVisitante;
use App\Models\Visitante;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcessoVisitanteTest extends TestCase
{
    use RefreshDatabase;

    public function test_acesso_visitante_can_be_created(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Pedro Souza',
            'documento' => '55544433322'
        ]);

        $acesso = AcessoVisitante::create([
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => now(),
            'motivo_visita' => 'Entrega'
        ]);

        $this->assertInstanceOf(AcessoVisitante::class, $acesso);
        $this->assertEquals('Entrega', $acesso->motivo_visita);
    }

    public function test_acesso_belongs_to_visitante(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Ana Costa',
            'documento' => '66677788899'
        ]);

        $acesso = AcessoVisitante::create([
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => now()
        ]);

        $this->assertInstanceOf(Visitante::class, $acesso->visitante);
        $this->assertEquals('Ana Costa', $acesso->visitante->nome);
    }

    public function test_acesso_has_datetime_casts(): void
    {
        $acesso = new AcessoVisitante();
        $casts = $acesso->getCasts();
        
        $this->assertArrayHasKey('data_hora_entrada', $casts);
        $this->assertArrayHasKey('data_hora_saida', $casts);
        $this->assertEquals('datetime', $casts['data_hora_entrada']);
    }
}
