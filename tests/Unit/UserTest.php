<?php

namespace Tests\Unit;

use App\Article;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_can_have_articles()
    {
        $user = factory(User::class)->create();
        factory(Article::class)->create(['user_id' => $user->id]);
        
        $this->assertInstanceOf(Article::class, $user->articles->first());
    }
}
