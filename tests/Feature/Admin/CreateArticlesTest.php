<?php

namespace Tests\Feature\Admin;

use App\Article;
use App\Image;
use App\Tag;
use Illuminate\Support\Facades\Storage;
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
        
        $this->assertCount(1, Article::withDrafts()->get());
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
    
    /** @test */
    public function it_saves_the_related_tags()
    {
        $this->signIn();
        $this->assertEquals(0, Tag::count());
        
        $this->post(route('admin.articles.store'), [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'tags' => [
                ['name' => 'foo'],
                ['name' => 'bar'],
            ],
        ]);
        $article = Article::withDrafts()->first();
        
        $this->assertCount(2, $article->tags);
        $this->assertEquals(2, Tag::count());
    }
    
    /** @test */
    public function it_can_have_a_image()
    {
        Storage::fake('public');
        $this->signIn();
        $image = factory(Image::class)->create();
        
        $this->post(route('admin.articles.store'), [
            'title' => 'Test Title',
            'image_id' => $image->id,
            'content' => 'Test Content',
        ]);
        
        $article = Article::withDrafts()->first();
        $this->assertInstanceOf(Image::class, $article->image);
    }
    
    /** @test */
    public function the_image_must_be_existent()
    {
        Storage::fake('public');
        $this->signIn();
    
        $response = $this->post(route('admin.articles.store'), [
            'title' => 'Test Title',
            'image_id' => 1,
            'content' => 'Test Content',
        ]);
        
        $response->assertSessionHasErrors('image_id');
    }
}
