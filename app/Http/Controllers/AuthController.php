<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller 
{
  function register(Request $request) {
    $validated = $request->validate(([
      'name' => 'required|string|max:100|min:3',
      'email' => 'required|string|email|unique:users,email',
      'password' => 'required|string|min:8'
    ]));

    $user = User::create([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'password' => Hash::make($validated['password'])
    ]);

    return response()->json(['message' => 'User registered successfully', 'user' => $user]);
  }

  function login(Request $request){
    $validated = $request -> validate([
      'email' => 'required|string|email',
      'password' => 'required|string|min:8'
    ]);


    $userFound = User::query() -> where('email', $validated['email']) -> first();

    if (!$userFound) {
      return response()->json(['error' => 'Invalid credentials'])->setStatusCode(401, 'Unauthorized');
    }

    $hashValidated = Hash::check($validated['password'], $userFound -> password);

    if (!$hashValidated) {
      return response()->json(['error' => 'Invalid credentials'])->setStatusCode(401, 'Unauthorized');
    }


    $token = $userFound->createToken(
      'api-token', 
    ['post:read', 'post:create', 'post:update', 'post:delete'],
    now()->addHour(24));

    return response()->json(['token' => $token->plainTextToken, 'user' => $userFound]);
  }
}