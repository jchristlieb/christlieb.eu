<?php

namespace Tests\Unit;

use App\Tag;
use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_knows_its_path()
    {
        $article = factory(Article::class)->create();

        $response = $this->get($article->path());

        $response->assertSee($article->title);
    }

    /** @test */
    public function it_may_has_tags()
    {
        $article = factory(Article::class)->create();
        $tags = factory(Tag::class, 2)->make();

        $article->tags()->saveMany($tags);

        $this->assertEquals(2, $article->tags->count());
        $this->assertEquals($tags->first()->name, $article->tags->first()->name);
    }

    /** @test */
    public function it_has_an_author()
    {
        $article = factory(Article::class)->create();

        $this->assertInstanceOf(User::class, $article->author);
    }
}
