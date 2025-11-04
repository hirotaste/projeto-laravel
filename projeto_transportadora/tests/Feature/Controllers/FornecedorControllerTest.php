<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Fornecedor;
use App\Models\User;

class FornecedorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_can_view_fornecedores_index(): void
    {
        $response = $this->get(route('fornecedores.index'));
        $response->assertStatus(200);
        $response->assertViewIs('fornecedores.index');
    }

    public function test_can_create_fornecedor(): void
    {
        $response = $this->post(route('fornecedores.store'), [
            'razao_social' => 'Fornecedor ABC Ltda',
            'cnpj' => '12345678901234',
            'responsavel' => 'José Gerente'
        ]);

        $response->assertRedirect(route('fornecedores.index'));
        $this->assertDatabaseHas('fornecedores', [
            'razao_social' => 'Fornecedor ABC Ltda',
            'cnpj' => '12345678901234'
        ]);
    }

    public function test_can_view_fornecedor(): void
    {
        $fornecedor = Fornecedor::create([
            'razao_social' => 'Fornecedor XYZ SA',
            'cnpj' => '98765432109876'
        ]);

        $response = $this->get(route('fornecedores.show', $fornecedor));
        $response->assertStatus(200);
        $response->assertSee('Fornecedor XYZ SA');
    }

    public function test_can_update_fornecedor(): void
    {
        $fornecedor = Fornecedor::create([
            'razao_social' => 'Empresa Original',
            'cnpj' => '11122233344455'
        ]);

        $response = $this->put(route('fornecedores.update', $fornecedor), [
            'razao_social' => 'Empresa Atualizada',
            'cnpj' => '11122233344455',
            'responsavel' => 'Maria Supervisora'
        ]);

        $response->assertRedirect(route('fornecedores.index'));
        $this->assertDatabaseHas('fornecedores', [
            'razao_social' => 'Empresa Atualizada',
            'responsavel' => 'Maria Supervisora'
        ]);
    }

    public function test_can_delete_fornecedor(): void
    {
        $fornecedor = Fornecedor::create([
            'razao_social' => 'Fornecedor a Deletar',
            'cnpj' => '55566677788899'
        ]);

        $response = $this->delete(route('fornecedores.destroy', $fornecedor));
        $response->assertRedirect(route('fornecedores.index'));
        $this->assertDatabaseMissing('fornecedores', ['id' => $fornecedor->id]);
    }

    public function test_cnpj_must_be_unique(): void
    {
        Fornecedor::create([
            'razao_social' => 'Fornecedor 1',
            'cnpj' => '99988877766655'
        ]);

        $response = $this->post(route('fornecedores.store'), [
            'razao_social' => 'Fornecedor 2',
            'cnpj' => '99988877766655'
        ]);

        $response->assertSessionHasErrors('cnpj');
    }
}
