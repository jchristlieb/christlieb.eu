<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        return view('admin.profile.show');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'image_id' => 'exists:images,id',
            'description' => 'min:5'
        ]);

        auth()->user()->update($data);

        return response()->json(auth()->user());
    }
}
