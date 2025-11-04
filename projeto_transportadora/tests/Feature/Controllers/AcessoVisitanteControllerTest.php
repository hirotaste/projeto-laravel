<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\AcessoVisitante;
use App\Models\Visitante;
use App\Models\User;

class AcessoVisitanteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_can_view_acessos_index(): void
    {
        $response = $this->get(route('acessos.index'));
        $response->assertStatus(200);
        $response->assertViewIs('acessos.index');
    }

    public function test_can_create_acesso(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Carlos Oliveira',
            'documento' => '66677788899'
        ]);
        
        $response = $this->post(route('acessos.store'), [
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => now()->format('Y-m-d H:i:s'),
            'motivo_visita' => 'Reunião',
            'responsavel_interno' => 'João Manager'
        ]);

        $response->assertRedirect(route('acessos.index'));
        $this->assertDatabaseHas('acessos_visitantes', [
            'visitante_id' => $visitante->id,
            'motivo_visita' => 'Reunião'
        ]);
    }

    public function test_can_view_acesso(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Laura Mendes',
            'documento' => '33344455566'
        ]);

        $acesso = AcessoVisitante::create([
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => now()
        ]);

        $response = $this->get(route('acessos.show', $acesso));
        $response->assertStatus(200);
        $response->assertSee('Laura Mendes');
    }

    public function test_can_update_acesso(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Roberto Souza',
            'documento' => '77788899900'
        ]);

        $acesso = AcessoVisitante::create([
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => now()
        ]);

        $entrada = now();
        $saida = $entrada->copy()->addHours(2);
        
        $response = $this->put(route('acessos.update', $acesso), [
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => $entrada->format('Y-m-d H:i:s'),
            'data_hora_saida' => $saida->format('Y-m-d H:i:s'),
            'motivo_visita' => 'Entrega atualizada'
        ]);

        $response->assertRedirect(route('acessos.index'));
        $this->assertDatabaseHas('acessos_visitantes', [
            'motivo_visita' => 'Entrega atualizada'
        ]);
    }

    public function test_can_delete_acesso(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Fernanda Rocha',
            'documento' => '88899900011'
        ]);

        $acesso = AcessoVisitante::create([
            'visitante_id' => $visitante->id,
            'data_hora_entrada' => now()
        ]);

        $response = $this->delete(route('acessos.destroy', $acesso));
        $response->assertRedirect(route('acessos.index'));
        $this->assertDatabaseMissing('acessos_visitantes', ['id' => $acesso->id]);
    }
}
