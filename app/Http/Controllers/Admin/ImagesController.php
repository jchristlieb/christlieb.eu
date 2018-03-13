<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ImagesController
 * @package App\Http\Controllers\Admin
 */
class ImagesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $images = Image::latest()->get();

        if ($request->wantsJson()) {
            return response()->json($images);
        }

        return view('admin.images.index', compact('images'));
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
