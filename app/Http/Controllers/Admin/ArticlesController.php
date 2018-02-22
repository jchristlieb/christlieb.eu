<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

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
            'title' => ['required', Rule::unique('articles')],
            'content' => ['required']
        ]);
        $article = new Article($data);
        $article->slug = str_slug($request->input('title'));
        $article->author()->associate(auth()->user());
        $article->save();

        if($request->wantsJson()){
            return response()->json($article);
        }
        
        flash('Successfully created new Article')->success();

        return redirect($article->path());
    }
    
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        
        return view('admin.articles.edit', compact('article'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->validate([
            'title' => ['required', Rule::unique('articles')->ignore($article->id)],
            'content' => ['required']
        ]));
    
        flash('Successfully updated Article')->success();
        
        return redirect(route('admin.articles.show', $article->id));
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
