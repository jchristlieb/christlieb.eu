<?php

namespace Tests\Unit;

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
    public function it_has_an_author()
    {
        $article = factory(Article::class)->create();

        $this->assertInstanceOf(User::class, $article->author);
    }
}
