<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

/**
 * Class TagsController.
 */
class TagsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tags = Tag::withCount('articles')->paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $tag = Tag::with('articles', 'image')->find($id);

        return view('admin.tags.show', compact('tag'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function update($id)
    {
        $tag = Tag::with('image')->findOrFail($id);
        $tag->update(request()->validate([
            'name' => ['required', Rule::unique('tags')->ignore($tag->id)],
            'image_id' => 'exists:images,id',
        ]));

        flash('Successfully updated Tag')->success();

        if (request()->wantsJson()) {
            return response()->json($tag);
        }

        return view('admin.tags.show', compact('tag'));
    }

    /**
     * @param $tagId
     * @param $articleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteArticleRelation($tagId, $articleId)
    {
        /** @var $tag Tag */
        $tag = Tag::findOrFail($tagId);
        $tag->articles()->detach($articleId);

        flash('Successfully removed Article from Tag')->success();

        return redirect()->back();
    }
}
