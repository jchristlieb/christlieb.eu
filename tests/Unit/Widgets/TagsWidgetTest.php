<?php

namespace Tests\Unit\Widgets;

use App\Tag;
use App\Article;
use Tests\TestCase;
use App\Widgets\TagsWidget;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsWidgetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_tags_with_articles_count()
    {
        factory(Tag::class)->create()->articles()->saveMany(factory(Article::class, 20)->create());

        $tagsWidget = $this->app->make(TagsWidget::class);

        $this->assertEquals(20, $tagsWidget->data()->first()->articles_count);
    }
}
