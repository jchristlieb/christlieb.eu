<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'email' => 'required|email|unique:users'
        ]);
        
        auth()->user()->update($data);
        
        return response()->json(auth()->user());
    }
}
