<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->file('image')->store('images', 'public');

        return response()->json(['image_url' => Storage::url($path)]);
    }
}
