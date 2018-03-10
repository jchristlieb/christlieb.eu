<?php

namespace Tests\Feature\Admin;

use App\Image;
use App\User;
use Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_update_his_profile()
    {
        $this->actingAs($user = factory(User::class)->create());

        $this->patch('/admin/profile', [
            'name' => 'updated name',
            'email' => 'updated@email.com',
        ]);

        $this->assertEquals('updated name', $user->fresh()->name);
        $this->assertEquals('updated@email.com', $user->fresh()->email);
    }

    /** @test */
    public function the_name_is_required()
    {
        $this->actingAs($user = factory(User::class)->create());

        $response = $this->patch('/admin/profile', [
            'name' => '',
            'email' => 'updated@email.com',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_email_is_required()
    {
        $this->actingAs($user = factory(User::class)->create());

        $response = $this->patch('/admin/profile', [
            'name' => 'updated name',
            'email' => '',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function the_email_has_to_be_valid()
    {
        $this->actingAs($user = factory(User::class)->create());

        $response = $this->patch('/admin/profile', [
            'name' => 'updated name',
            'email' => 'no real email address',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function the_email_has_to_be_unique()
    {
        factory(User::class)->create(['email' => 'john@example.com']);
        $this->actingAs($user = factory(User::class)->create());

        $response = $this->patch('/admin/profile', [
            'name' => 'updated name',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }
    
    /** @test */
    public function a_user_can_add_a_description()
    {
        $this->actingAs($user = factory(User::class)->create());
    
        $this->patch('/admin/profile', [
            'name' => 'updated name',
            'email' => 'john@example.com',
            'description' => 'a test description'
        ]);
        
        $this->assertEquals('a test description', $user->fresh()->description);
    }
    
    /** @test */
    public function a_user_can_add_an_image_to_his_profile()
    {
        $this->withoutExceptionHandling();
        Storage::fake('public');
        $image = factory(Image::class)->create();
        $this->actingAs($user = factory(User::class)->create());
    
        $this->patch('/admin/profile', [
            'name' => 'updated name',
            'email' => 'updated@email.com',
            'image_id' => $image->id
        ]);
        
        $user = User::with('image')->first();
        $this->assertInstanceOf(Image::class, $user->image);
    }
    
}
