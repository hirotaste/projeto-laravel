<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Visitante;
use App\Models\FuncaoVisitante;
use App\Models\User;

class VisitanteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_can_view_visitantes_index(): void
    {
        $response = $this->get(route('visitantes.index'));
        $response->assertStatus(200);
        $response->assertViewIs('visitantes.index');
    }

    public function test_can_create_visitante(): void
    {
        $funcao = FuncaoVisitante::create(['descricao' => 'Visitante']);
        
        $response = $this->post(route('visitantes.store'), [
            'nome' => 'João Silva',
            'documento' => '12345678900',
            'empresa' => 'Empresa ABC',
            'funcao_id' => $funcao->id
        ]);

        $response->assertRedirect(route('visitantes.index'));
        $this->assertDatabaseHas('visitantes', [
            'nome' => 'João Silva',
            'documento' => '12345678900'
        ]);
    }

    public function test_can_view_visitante(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Maria Santos',
            'documento' => '98765432100'
        ]);

        $response = $this->get(route('visitantes.show', $visitante));
        $response->assertStatus(200);
        $response->assertSee('Maria Santos');
    }

    public function test_can_update_visitante(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Pedro Costa',
            'documento' => '11122233344'
        ]);

        $response = $this->put(route('visitantes.update', $visitante), [
            'nome' => 'Pedro Costa Jr',
            'documento' => '11122233344',
            'empresa' => 'Nova Empresa'
        ]);

        $response->assertRedirect(route('visitantes.index'));
        $this->assertDatabaseHas('visitantes', [
            'nome' => 'Pedro Costa Jr',
            'empresa' => 'Nova Empresa'
        ]);
    }

    public function test_can_delete_visitante(): void
    {
        $visitante = Visitante::create([
            'nome' => 'Ana Lima',
            'documento' => '55566677788'
        ]);

        $response = $this->delete(route('visitantes.destroy', $visitante));
        $response->assertRedirect(route('visitantes.index'));
        $this->assertDatabaseMissing('visitantes', ['id' => $visitante->id]);
    }
}
