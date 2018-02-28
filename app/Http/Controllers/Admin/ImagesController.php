<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    public function index(Request $request)
    {
        $images = Image::all();

        if ($request->wantsJson()) {
            return response()->json($images);
        }

        return view('admin.images.index', compact('images'));
    }

    public function store(Request $request)
    {
        $uploadedFile = $request->file('image');
        $image = new Image();
        $image->title = $uploadedFile->getClientOriginalName();
        $image->path = $uploadedFile->store('images', 'public');
        $image->save();

        return response()->json($image);
    }
}
