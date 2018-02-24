<?php

namespace Tests\Feature;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FrontpageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_contains_only_promoted_articles(){
        factory(Article::class, 10)->create();
        collect(['promoted_first', 'promoted_second', 'promoted_third'])->each(function ($state){
            factory(\App\Article::class)->states($state)->create();
        });

        $response = $this->get('/');

        $this->assertCount(3, $response->original->getData()['promotedArticles']);
    }
}
