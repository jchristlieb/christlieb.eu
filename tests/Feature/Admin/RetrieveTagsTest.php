<?php

namespace Tests\Feature\Admin;

use App\Tag;
use App\Article;
use function foo\func;
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

        $tags->each(function ($tag) use ($response){
           $response->assertSee($tag->name);
        });
    }
    
    /** @test */
    public function single_tag_can_be_shown()
    {
        $this->signIn();
        $tag = factory(Tag::class)->create();
    
        $response = $this->get(route('admin.tags.show', $tag->id));
        
        $response->assertSee($tag->name);
    }
}
