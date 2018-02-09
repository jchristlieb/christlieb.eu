<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_login()
    {
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'password' => bcrypt('secret')
        ]);

        $response = $this->post('/login',[
            'email' => 'john@example.com',
            'password' => 'secret'
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '12345',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        $response = $this->post('/login', [
            'email' => 'john@example.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function cant_login_with_invalid_credentials()
    {
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $this->post('/login', [
            'email' => 'not-existend@user.com',
            'password' => '9s8gy8s9diguh4iev',
        ]);
    }

    /** @test */
    public function a_user_can_log_out()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/logout')
            ->assertRedirect('/');

        $this->assertFalse($this->isAuthenticated());
    }
}
