<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller 
{
  function getUser() {
    return response()->json(['name' => 'Allan Cássio']);
  }

  function createUser(Request $request){
    $validated = $request -> validate([
      'email' => 'required|email',
      'password' => 'required|min:6'
    ]);

    return response()->json(['email' => $validated['email']]);
  }
}