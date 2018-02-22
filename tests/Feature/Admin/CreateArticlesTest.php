<?php

namespace Tests\Feature\Admin;

use App\Article;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cant_visit_create_articles_page()
    {
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.articles.create'));
    }

    /** @test */
    public function a_user_can_create_posts()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->post(route('admin.articles.store'), [
            'title' => 'Test Title',
            'content' => 'Test Content',
        ]);

        $this->assertCount(1, Article::all());
        $this->assertEquals('success', session()->get('flash_notification')->first()->level);
    }

    /** @test */
    public function the_title_is_required()
    {
        $this->signIn();

        $response = $this->post(route('admin.articles.store'), [
            'title' => '',
            'content' => 'Test Content',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function the_title_must_be_unique()
    {
        $this->signIn();
        factory(Article::class)->create(['title' => 'test title']);

        $response = $this->post('/admin/articles/create', [
            'title' => 'test title',
            'content' => 'test content',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function the_content_is_required()
    {
        $this->signIn();

        $response = $this->post(route('admin.articles.store'), [
            'title' => 'Test Title',
            'content' => '',
        ]);

        $response->assertSessionHasErrors('content');
    }
}
