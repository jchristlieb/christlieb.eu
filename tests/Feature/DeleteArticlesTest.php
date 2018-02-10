<?php

namespace Tests\Feature;

use App\Article;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cant_delete_articles()
    {
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $this->delete('/blog/article-slug');
    }

    /** @test */
    public function a_user_can_delete_articles()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $post = factory(Article::class)->create();

        $this->assertEquals(1, Article::count());

        $this->delete("/blog/{$post->slug}");

        $this->assertEquals(0, Article::count());
    }
}
