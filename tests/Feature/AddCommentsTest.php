<?php

namespace Tests\Feature;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCommentsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_guest_can_add_a_comment_to_an_article()
    {
        $this->withoutExceptionHandling();
        
        $article = factory(Article::class)->create();
        
        $this->post("{$article->path()}/comments",[
            'name' => 'guest',
            'content' => 'the comment content'
        ]);
        
        $this->assertCount(1, $article->fresh()->comments);
    }
}
