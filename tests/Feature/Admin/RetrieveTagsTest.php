<?php

namespace Tests\Feature\Admin;

use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetrieveTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_tags_can_be_listed()
    {
        $this->signIn();
        $tags = factory(Tag::class, 5)->create();

        $response = $this->get(route('admin.tags.index'));

        $tags->each(function ($tag) use ($response) {
            $response->assertSee($tag->name);
        });
    }
}
