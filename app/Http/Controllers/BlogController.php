<?php

namespace App\Http\Controllers;

use App\Article;

/**
 * Class BlogController.
 */
class BlogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(10);

        return view('blog.index', compact('articles'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($slug)
    {
        $article = Article::with('image', 'author.image')->where('slug', $slug)->first();

        return view('blog.single', compact('article'));
    }
}
