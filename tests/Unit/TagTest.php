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

    /** @test */
    public function it_cascades_on_delete()
    {
        $article = factory(Article::class)->create();
        $tag = factory(Tag::class)->create();
        $article->tags()->save($tag);

        $this->assertDatabaseHas('article_tag', [
            'article_id' => $article->id,
            'tag_id' => $tag->id,
        ]);

        $tag->delete();

        $this->assertDatabaseMissing('article_tag', [
            'article_id' => $article->id,
            'tag_id' => $tag->id,
        ]);
    }
}
