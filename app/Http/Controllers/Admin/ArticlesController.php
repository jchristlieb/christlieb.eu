<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $articles = Article::withDrafts()->latest()->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::withDrafts()->with('tags', 'image')->find($id);

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
            'content' => ['required'],
            'published_at' => 'date|date_format:Y-m-d|after:today',
            'image_id' => 'exists:images,id',
        ]);
        $article = new Article($data);
        $article->slug = str_slug($request->input('title'));
        $article->author()->associate(auth()->user());

        if ($imageId = $request->input('image_id')) {
            $article->image_id = $imageId;
        }
        $article->save();

        $tags = collect($request->input('tags', []))->pluck('name')->toArray();
        /* @var $article Article */
        $article->syncTags($tags);

        if ($request->wantsJson()) {
            return response()->json($article);
        }

        flash('Successfully created new Article')->success();

        return redirect($article->path());
    }

    public function edit($id)
    {
        $article = Article::withDrafts()->with('image', 'tags')->findOrFail($id);

        $article->tags = $article->tags->pluck('name');

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
        $article = Article::withDrafts()->findOrFail($id);
        $article->update($request->validate([
            'title' => ['required', Rule::unique('articles')->ignore($article->id)],
            'content' => ['required'],
            'image_id' => 'exists:images,id',
        ]));

        $tags = collect($request->input('tags', []))->pluck('name')->toArray();
        /* @var $article Article */
        $article->syncTags($tags);
        if ($request->wantsJson()) {
            return response()->json($article);
        }

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
