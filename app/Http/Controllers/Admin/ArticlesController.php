<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ArticlesController.
 */
class ArticlesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::paginate(10);

        return view('admin.articles.index', compact('articles'));
    }
    
    public function show($id)
    {
        $article = Article::with('tags')->find($id);
        
        return view('admin.articles.show', compact('article'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->validate([
           'title' => 'required',
           'content' => 'required',
        ]);
        $article = new Article($request->only(['title', 'content']));
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
