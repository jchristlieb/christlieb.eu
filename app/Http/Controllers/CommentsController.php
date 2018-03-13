<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, $slug)
    {
        $commentData = $request->validate([
           'name' => 'required',
           'content' => 'required',
        ]);

        $article = Article::where('slug', $slug)->first();

        $article->comments()->create($commentData);

        return redirect($article->path());
    }
}
