<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

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
    
    public function store(Request $request)
    {
        $data = $request->validate([
           'title' => 'required',
           'content' => 'required',
        ]);
        $article = new Article($request->only(['title','content']));
        $article->slug = str_slug($request->input('title'));
        $article->author()->associate(auth()->user());
        $article->save();
    
        flash('Successfully created new Article')->success();
        
        return redirect($article->path());
    }
    
    /**
     * @param $id int
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        
        flash('Successfully deleted Article')->success();

        return redirect()->back();
    }
}
