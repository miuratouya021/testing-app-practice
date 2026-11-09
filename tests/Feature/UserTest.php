<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
        ]);

        $response = $this->get('/');

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(200);
    }

    public function test_duplicate_email()
    {
        User::factory()->create([
            'name' => 'テストユーザー1',
            'email' => 'test@example.com',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create([
            'name' => 'テストユーザー2',
            'email' => 'test@example.com',
        ]);
    }
}
