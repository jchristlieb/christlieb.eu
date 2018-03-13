<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Admin
 */
class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('admin.profile.show');
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'image_id' => 'exists:images,id',
            'description' => 'min:5',
        ]);

        auth()->user()->update($data);

        return response()->json(auth()->user());
    }
}
