<?php

namespace Tests\Feature\Admin;

use App\Image;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetImagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_images_can_be_listed()
    {
        \Storage::fake('public');
        $this->signIn();
        factory(Image::class, 5)->create();

        $response = $this->get(route('admin.images.index'));

        $this->assertCount(5, $response->original->getData()['images']);
    }
}
