<?php

namespace Tests\Unit;

use App\Article;
use App\User;
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
    
    /** @test */
    public function it_has_an_author()
    {
        $article = factory(Article::class)->create();
        
        $this->assertInstanceOf(User::class, $article->author);
    }
}