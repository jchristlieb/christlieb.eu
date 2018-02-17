<?php

namespace Tests\Feature\Admin;

use App\Tag;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTagsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function an_article_can_be_detached_from_a_tag()
    {
        $tag = factory(Tag::class)->create();
        $article = factory(Article::class)->create();
        $tag->articles()->attach($article);

        $this->assertEquals(1, $tag->fresh()->articles->count());

        $this->delete(route('admin.tags.article.delete', [$tag->id, $article->id]));

        $this->assertEquals('success', session()->get('flash_notification')->first()->level);
        $this->assertEquals(0, $tag->fresh()->articles->count());
    }

    /** @test */
    public function the_name_can_be_updated()
    {
        $tag = factory(Tag::class)->create();

        $this->patch("/admin/tags/{$tag->id}", ['name' => 'updated name']);

        $this->assertEquals('updated name', $tag->fresh()->name);
    }

    /** @test */
    public function the_name_must_be_unique()
    {
        factory(Tag::class)->create(['name' => 'test']);
        $secondTag = factory(Tag::class)->create();

        $response = $this->patch("/admin/tags/{$secondTag->id}", ['name' => 'test']);

        $response->assertSessionHasErrors('name');
    }
}
