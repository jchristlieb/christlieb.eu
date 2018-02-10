<?php

namespace App\Http\Controllers;

use App\Article;

class ArticlesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();

        return view('articles.show', compact('article'));
    }
    
    /**
     * @param $slug string
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        Article::where('slug', $slug)->delete();
        
        return redirect()->back();
    }
}
