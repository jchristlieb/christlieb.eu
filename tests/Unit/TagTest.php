<?php

namespace Tests\Unit;

use App\Tag;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_may_has_articles()
    {
        $tag = factory(Tag::class)->create();
        $article = factory(Article::class)->make();
    
        $tag->articles()->save($article);
    
        $this->assertEquals(1, $tag->articles->count());
        $this->assertEquals($article->name, $tag->articles->first()->name);
    }
    
}
