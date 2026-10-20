<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_staff_management_and_creation(): void
    {
        $admin = User::factory()->create(['role' => 'Admin']);

        $response = $this->actingAs($admin)->get(route('users.index'));
        $response->assertStatus(200);
        $response->assertSee('Manajemen Staf & Petugas');

        $responseBooks = $this->actingAs($admin)->get(route('books.create'));
        $responseBooks->assertStatus(200);

        $responseMembers = $this->actingAs($admin)->get(route('members.create'));
        $responseMembers->assertStatus(200);
    }

    public function test_petugas_cannot_access_admin_only_routes(): void
    {
        $petugas = User::factory()->create(['role' => 'Petugas']);

        // Cannot access users list
        $response = $this->actingAs($petugas)->get(route('users.index'));
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error');

        // Cannot access book creation
        $responseBooks = $this->actingAs($petugas)->get(route('books.create'));
        $responseBooks->assertRedirect(route('dashboard'));
        $responseBooks->assertSessionHas('error');

        // Cannot access member creation
        $responseMembers = $this->actingAs($petugas)->get(route('members.create'));
        $responseMembers->assertRedirect(route('dashboard'));
        $responseMembers->assertSessionHas('error');
    }

    public function test_petugas_can_access_operational_routes(): void
    {
        $petugas = User::factory()->create(['role' => 'Petugas']);

        $response = $this->actingAs($petugas)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Mode: Petugas Sirkulasi');

        $responseLoans = $this->actingAs($petugas)->get(route('loans.create'));
        $responseLoans->assertStatus(200);

        $responseReturns = $this->actingAs($petugas)->get(route('returns.index'));
        $responseReturns->assertStatus(200);
    }
}

