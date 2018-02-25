<?php

namespace Tests\Feature;

use App\Tag;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_tags_can_be_retrieved_as_json()
    {
        $tags = factory(Tag::class, 5)->create();

        $response = $this->get('/tags');

        $this->assertJson($response->getContent(), $tags->toJson());
    }

    /** @test */
    public function the_single_tag_page_has_related_articles()
    {
        $tag = factory(Tag::class)->create();
        $articles = factory(Article::class, 5)->create();
        $tag->articles()->saveMany($articles);

        $response = $this->get("/tags/{$tag->slug}");

        $articles->each(function ($article) use ($response) {
            $response->assertSee($article->title);
        });
    }
}
