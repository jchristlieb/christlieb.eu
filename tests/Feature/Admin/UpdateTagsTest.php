<?php

namespace Tests\Feature\Admin;

use App\Tag;
use App\Article;
use function foo\func;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTagsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        
        $this->signIn();
    }
    
    /** @test */
    public function an_article_can_be_detached_from_a_tag()
    {
        $tag = factory(Tag::class)->create();
        $article = factory(Article::class)->create();
        $tag->articles()->attach($article);
    
        $this->assertEquals(1, $tag->fresh()->articles->count());
    
        $this->delete(route('admin.tags.article.delete',[$tag->id, $article->id]));

        $this->assertEquals(0, $tag->fresh()->articles->count());
    }

    /** @test */
    public function the_name_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $tag = factory(Tag::class)->create();
        
        $this->patch("/admin/tags/{$tag->id}", ['name' => 'updated name']);
        
        $this->assertEquals('updated name', $tag->fresh()->name);
    }
}
