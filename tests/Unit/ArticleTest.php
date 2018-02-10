<?php

namespace Tests\Unit;

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

        $viewData = $this->getViewData($this->get($article->path()));

        $this->assertEquals($article->fresh(), $viewData['article']);
    }
}
