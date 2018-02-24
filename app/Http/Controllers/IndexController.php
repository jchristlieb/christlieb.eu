<?php

namespace App\Http\Controllers;

use App\Article;

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
        $promotedArticles = Article::whereNotNull('promoted')->with('author', 'tags')->get();

        return view('index', compact('promotedArticles'));
    }
}
