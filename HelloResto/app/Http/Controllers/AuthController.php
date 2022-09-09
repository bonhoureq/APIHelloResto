<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:45',
            'password' => 'required|max:155',
            'email' => 'required|email|unique:users|max:255',
            'name' => 'required|max:45',
            'firstname' => 'required|max:45',
            'age' => 'required',
        ]);

        $validated = $validator->validated();
        $validated['password'] = Hash::make($request->password);
        $user = User::create($validated);
        return response()->json([
            'token' =>$user->createToken('API Token')->plainTextToken
        ],201);
    }

    public function connect(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:45',
            'password' => 'required|max:155'
        ]);


        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return response()->json("200");
        }
        return response()->json("400");
    }

    public function show()
    {
        $users = User::all();
        return response()->json([$users->getAttributes]);
    }
}
