<?php

namespace Tests\Feature;

use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetrieveTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_tags_can_be_retrieved_as_json()
    {
        $tags = factory(Tag::class, 5)->create();

        $response = $this->get('/tags');

        $this->assertJson($response->getContent(), $tags->toJson());
    }
}
