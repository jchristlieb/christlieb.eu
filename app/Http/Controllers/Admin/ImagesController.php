<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function index(Request $request)
    {
        $images = Image::all();
        
        if($request->wantsJson()){
            return response()->json($images);
        }
        
        return view('admin.images.index', compact('images'));
    }
    
//    public function store(Request $request)
//    {
//        $path = $request->file('image')->store('images', 'public');
//
//        return response()->json(['image_url' => Storage::url($path)]);
//    }
}
