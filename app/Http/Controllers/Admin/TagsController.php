<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('articles')->paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

    public function show($id)
    {
        $tag = Tag::with('articles', 'image')->find($id);

        return view('admin.tags.show', compact('tag'));
    }

    public function update($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update(request()->validate([
            'name' => ['required', Rule::unique('tags')->ignore($tag->id)],
            'image_id' => 'exists:images,id'
        ]));

        flash('Successfully updated Tag')->success();

        if (request()->wantsJson()) {
            return response()->json($tag);
        }

        return view('admin.tags.show', compact('tag'));
    }

    public function deleteArticleRelation($tagId, $articleId)
    {
        /** @var $tag Tag */
        $tag = Tag::findOrFail($tagId);
        $tag->articles()->detach($articleId);

        flash('Successfully removed Article from Tag')->success();

        return redirect()->back();
    }
}
