<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\SendWelcomeMail;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user_successfully()
    {
        Mail::fake();
        Log::spy();

        $response = $this->postJson('/api/register', [
            'pharma_name' => 'Test Pharma',
            'pharmacist_name' => 'Test Pharmacist',
            'password' => 'password',
            'email' => 'test@example.com',
            'license_date' => '2024-06-24',
            'license_number' => '123456',
            'phone' => '1234567890',
            'address' => 'Test Address',
            'pharmacist_gender' => 'Male',
            'is_band' => false,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'user' => [
                         'id',
                         'pharma_name',
                         'pharmacist_name',
                         'email',
                         // Other fields...
                     ],
                     'authorisation' => [
                         'token',
                         'type'
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        Mail::assertSent(SendWelcomeMail::class);
    }

    /** @test */
    public function it_logs_in_a_user_successfully()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'user' => [
                         'id',
                         'pharma_name',
                         'pharmacist_name',
                         'email',
                         // Other fields...
                     ],
                     'authorisation' => [
                         'token',
                         'type'
                     ]
                 ]);
    }

    /** @test */
    public function it_fails_to_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Unauthorized',
                 ]);
    }

    /** @test */
    public function it_logs_out_a_user_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Successfully logged out',
                 ]);
    }

    /** @test */
    public function it_refreshes_a_token_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->postJson('/api/refresh');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'user' => [
                         'id',
                         'pharma_name',
                         'pharmacist_name',
                         'email',
                         // Other fields...
                     ],
                     'authorisation' => [
                         'token',
                         'type'
                     ]
                 ]);
    }

    /** @test */
    public function it_shows_user_details_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->getJson('/api/user/' . $user->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data' => [
                         'id',
                         'pharma_name',
                         'pharmacist_name',
                         'email',
                         // Other fields...
                     ],
                 ]);
    }

    /** @test */
    public function it_updates_user_details_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->putJson('/api/user/' . $user->id, [
            'pharma_name' => 'Updated Pharma Name',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'User updated successfully',
                     'data' => [
                         'id' => $user->id,
                         'pharma_name' => 'Updated Pharma Name',
                         // Other fields...
                     ],
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'pharma_name' => 'Updated Pharma Name',
        ]);
    }

    /** @test */
    public function it_deletes_user_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->deleteJson('/api/user/' . $user->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'User deleted successfully',
                 ]);

        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);
    }

    /** @test */
    public function it_restores_deleted_user_successfully()
    {
        $user = User::factory()->create();
        $user->delete();

        $this->actingAs($user, 'api');

        $response = $this->postJson('/api/user/restore/' . $user->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'User restored successfully',
                     'data' => [
                         'id' => $user->id,
                         // Other fields...
                     ],
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function it_force_deletes_user_successfully()
    {
        $user = User::factory()->create();
        $user->delete();

        $this->actingAs($user, 'api');

        $response = $this->deleteJson('/api/user/force-delete/' . $user->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'User force deleted successfully',
                 ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}

