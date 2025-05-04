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

    function sendverify(Request $request)
    {
        $request->validate([
            'username' => 'required|max:50'
        ]);
        $code = rand(10000000, 99999999);
        if ($user = User::where('phone', $request->username)->first()) {
            $user->password = Hash::make($code);
            $user->save();
        } else {
            $user = User::create([
                'name' => '',
                'phone' => $request->username,
                'password' => Hash::make($code),
            ]);
        }
        $user->sendVerifyCode($code, $request->username);
        return response()->json(['status' => true], 200);
        // if ($user->sendVerifyCode($code, $request->username)) {
        //     return response()->json(['status' => true], 200);
        // } else {
        //     return response()->json(['status' => false], 400);
        // }
    }
}
