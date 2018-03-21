<?php

namespace Tests\Feature\Admin;

use App\Image;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateImagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_upload_images()
    {
        $this->signIn();
        Storage::fake('public');
        $this->assertEquals(0, Image::count());

        $this->post('/admin/images', ['image' => UploadedFile::fake()->image('image.jpg')]);

        $this->assertEquals(1, Image::count());
        Storage::disk('public')->assertExists(Image::first()->path);
    }
}
