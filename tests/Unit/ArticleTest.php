<?php

namespace Tests\Unit;

use App\Tag;
use App\User;
use App\Article;
use Carbon\Carbon;
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

        $article->delete();

        $this->assertDatabaseMissing('article_tag', [
            'article_id' => $article->id,
            'tag_id' => $tag->id,
        ]);
    }

    /** @test */
    public function it_can_be_published_instantly()
    {
        $article = factory(Article::class)->states('unpublished')->create();
        $this->assertFalse($article->fresh()->is_published);

        $article->publish();

        $this->assertTrue($article->fresh()->is_published);
    }

    /** @test */
    public function it_can_be_published_on_date()
    {
        $article = factory(Article::class)->states('unpublished')->create();
        $this->assertFalse($article->fresh()->is_published);

        $article->publish(Carbon::now()->subDay());
        $this->assertFalse($article->fresh()->is_published);

        $this->artisan('christlieb:publish');

        $this->assertTrue($article->fresh()->is_published);
    }

    /** @test */
    public function not_published_articles_are_excluded_by_default()
    {
        factory(Article::class, 10)->states('unpublished')->create();

        $this->assertCount(0, Article::all());
    }

    /** @test */
    public function not_published_articles_can_be_included()
    {
        factory(Article::class, 10)->states('unpublished')->create();

        $this->assertCount(10, Article::withDrafts()->get());
    }

    /** @test */
    public function it_can_get_one_newer_article()
    {
        factory(Article::class, 30)->create();
        $article = Article::find(15);

        $newerArticle = $article->newerArticle();

        $this->assertTrue($newerArticle->published_at->gt($article->published_at));
    }

    /** @test */
    public function it_can_get_one_older_article()
    {
        factory(Article::class, 30)->create();
        $article = Article::find(15);

        $olderArticle = $article->olderArticle();

        $this->assertTrue($article->published_at->gt($olderArticle->published_at));
    }
}
