<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_password_reset_route_exists()
    {
        $this->get('password/reset')->assertStatus(200);
    }

    /** @test */
    public function email_is_required_in_email_password_form()
    {
        $response = $this->post('/password/reset', ['email' => '']);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_notification_gets_sent_if_password_reset_is_requested()
    {
        $user = factory(User::class)->create(['email' => 'john@example.com']);
        Notification::fake();

        $this->post('password/email', ['email' => 'john@example.com']);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /** @test */
    public function the_reset_password_form_has_required_fields()
    {
        $response = $this->post('password/reset', [
            'token' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors(['token', 'email', 'password']);
    }

    /** @test
     * @throws \Exception
     */
    public function a_password_can_be_resetted()
    {
        $user = factory(User::class)->create(['email' => 'john@example.com']);
        $token = $this->app->make('auth.password.broker')->createToken($user);

        $this->post('password/reset', [
            'token' => $token,
            'email' => 'john@example.com',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);

        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));
    }
}
