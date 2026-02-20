<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller 
{
  function register(Request $request) {
    return response()->json(['name' => 'Allan Cássio']);
  }

  function login(Request $request){
    $validated = $request -> validate([
      'email' => 'required|email',
      'password' => 'required|min:6'
    ]);

    return response()->json(['email' => $validated['email']]);
  }
}