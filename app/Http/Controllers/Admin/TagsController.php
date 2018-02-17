<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        return view('admin.tags.index', ['tags' => Tag::paginate(15)]);
    }

    public function show($id)
    {
        $tag = Tag::find($id)->with('articles')->first();

        return view('admin.tags.show', compact('tag'));
    }
    
    public function update($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update(['name' => request()->input('name')]);
        
        return view('admin.tags.show', compact('tag'));
    }
    
    public function deleteArticleRelation($tagId, $articleId)
    {
        /**@var $tag Tag */
        $tag = Tag::findOrFail($tagId);
        $tag->articles()->detach();
        
        return redirect()->back();
    }
}
