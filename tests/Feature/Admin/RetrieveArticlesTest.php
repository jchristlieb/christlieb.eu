<?php

namespace Tests\Feature\Admin;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetrieveArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_tags_can_be_listed()
    {
        $this->signIn();
        $articles = factory(Article::class, 5)->create();

        $response = $this->get(route('admin.articles.index'));
    
        $articles->each(function ($article) use ($response) {
            $response->assertSee($article->title);
        });
    }
    
}
