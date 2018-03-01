<?php

namespace Tests\Feature;

use App\Mail\ContactForm;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class ContactFormTest extends TestCase
{
    /** @test */
    public function the_contact_route_exists()
    {
        $this->get('/contact')->assertStatus(200);
    }

    /** @test */
    public function a_contact_mail_gets_sent()
    {
        Mail::fake();

        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message',
        ]);
    
        $this->assertEquals('success', session()->get('flash_notification')->first()->level);
    
        Mail::assertSent(ContactForm::class);
    }

    /** @test */
    public function it_redirects_back_after_success()
    {
        $response = $this->from('/contact')->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message',
        ]);

        $response->assertRedirect('/contact');
    }
    

    /** @test */
    public function name_is_required()
    {
        $response = $this->post('/contact', [
            'email' => 'john@example.com',
            'message' => 'This is a test message',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'message' => 'This is a test message',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function message_is_required()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('message');
    }
}
