<?php

namespace App\Http\Controllers;

use App\Tag;

/**
 * Class TagsController.
 */
class TagsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Tag::all());
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->with('articles')->first();
        abort_unless($tag, 404);

        return view('tags.show', compact('tag'));
    }
}
