<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{
    public function index()
    {
        return view('admin.tags.index',['tags' => Tag::paginate(15)]);
    }

    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->with('articles')->first();

        return view('admin.tags.show', compact('tag'));
    }
}
