<?php

namespace Tests\Unit\Widgets;

use App\Article;
use Carbon\Carbon;
use Tests\TestCase;
use App\Widgets\LatestArticleWidget;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LatestArticleWidgetTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_returns_the_latest_article()
    {
        factory(Article::class,30)->create(['created_at' => Carbon::now()->subMonth()]);
        $latestArticle = factory(Article::class)->create();
        
        $latestArticleWidget = $this->app->make(LatestArticleWidget::class);
        
        $this->assertEquals($latestArticle->fresh(), $latestArticleWidget->data());
    }
}
