<?php

namespace App\Http\Controllers;

use App\Article;

/**
 * Class ArticlesController.
 */
class BlogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::paginate(10);

        return view('blog.index', compact('articles'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($slug)
    {
        $article = Article::where('slug', $slug)->first();

        return view('blog.single', compact('article'));
    }
}
