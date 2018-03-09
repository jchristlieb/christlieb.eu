<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;

/**
 * Class IndexController.
 */
class IndexController extends Controller
{
    /**
     * We only have one route on this controller so we can easily invoke it.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $tags = Tag::withCount('articles')->with('image')->orderBy('articles_count', 'desc')->limit(2)->get();

        $promotedArticles = Article::whereNotNull('promoted')->with('author', 'tags', 'image')->get();

        return view('index', compact('promotedArticles', 'tags'));
    }
}
