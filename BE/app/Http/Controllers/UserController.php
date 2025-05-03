<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|unique:users|max:12',
            'password' => 'required|min:8|max:64',
        ]);
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([$user, 201]);
    }
}
