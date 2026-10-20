<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_correct_stats()
    {
        $category = Category::factory()->create();
        Book::factory()->count(5)->create(['category_id' => $category->id, 'stock' => 2]);
        Member::factory()->count(3)->create(['status' => 'Aktif']);
        Loan::factory()->count(2)->create(['status' => 'Dipinjam']);

        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Total Buku');
        $response->assertSee('Buku Tersedia');
        $response->assertSee('Buku Dipinjam');
        $response->assertSee('Total Anggota');
    }
}