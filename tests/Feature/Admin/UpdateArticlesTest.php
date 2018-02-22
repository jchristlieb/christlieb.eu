<?php

namespace Tests\Feature\Admin;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_edit_articles_page_contains_the_right_article()
    {
        $this->signIn();
        $article = factory(Article::class)->create();

        $response = $this->get('/admin/articles/edit/1');

        $this->assertEquals($article->fresh(), $response->original->getData()['article']);
    }

    /** @test */
    public function a_user_can_update_articles()
    {
        $this->signIn();
        $article = factory(Article::class)->create();

        $this->patch("/admin/articles/{$article->id}", [
            'title' => 'updated title',
            'content' => 'updated content',
        ]);
        $this->assertEquals('success', session()->get('flash_notification')->first()->level);

        $this->assertEquals('updated title', $article->fresh()->title);
        $this->assertEquals('updated content', $article->fresh()->content);
    }

    /** @test */
    public function the_title_is_required()
    {
        $this->signIn();
        $article = factory(Article::class)->create();

        $response = $this->patch("/admin/articles/{$article->id}", [
            'title' => '',
            'content' => 'updated content',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function the_title_must_be_unique()
    {
        $this->signIn();
        factory(Article::class)->create(['title' => 'test title']);
        $article = factory(Article::class)->create();

        $response = $this->patch("/admin/articles/{$article->id}", [
            'title' => 'test title',
            'content' => 'updated content',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function the_content_is_required()
    {
        $this->signIn();
        $article = factory(Article::class)->create();

        $response = $this->patch("/admin/articles/{$article->id}", [
            'title' => 'updated title',
            'content' => '',
        ]);

        $response->assertSessionHasErrors('content');
    }
}
