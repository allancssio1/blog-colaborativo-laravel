<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller 
{
  function listPost() {
    return response()->json(['posts' => [
      'title' => 'Post teste',
      'subtitle' => 'Subtitulo teste' 
    ]]);
  }
  function getById(string $id) {
    return response()->json(['posts' => [
      "id" => $id,  
      'title' => 'Post teste',
      'subtitle' => 'Subtitulo teste' 
    ]]);
  }

  function createPost(Request $request){
    $validated = $request -> validate([
      'userId' => 'required|number',
      'title' => 'required|min:3',
      'subtitle' => 'required|min:10'
    ]);

    return response()->json([$validated]);
  
  }

  function updatePost(Request $request){
    $validated = $request -> validate([
      'userId' => 'required|number',
      'id' => 'required|number',
      'title' => 'required|min:3',
      'subtitle' => 'required|min:10'
    ]);

    return response()->json([$validated]);
  }

  function deletePost(Request $request){
    $validated = $request -> validate([
      'id' => 'required|number'
    ]);

    return response()->json(['message' => 'Post Deleted']);
  }
}