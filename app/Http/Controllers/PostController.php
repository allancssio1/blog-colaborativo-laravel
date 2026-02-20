<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller 
{
  function listPost() {
    $posts = Post::all();
    return response()->json($posts);
  }

  function getById(string $id) {
    $post = Post::find($id);


    return response()->json([$post]);
  }

  function createPost(Request $request){
    $validated = $request -> validate([
      'userId' => 'required|int',
      'title' => 'required|min:3',
      'content' => 'required|min:10'
    ]);

    $user = User::query()-> where('id', $validated['userId']) -> first();

    if (!$user) {
      return response()->json(['error' => 'User not found']);
    }

    $post = Post::create([
      "title" => $validated['title'],
      "content" => $validated['content'],
      "author_id" => $user->id
    ]);

    return response()->json([$post]);
  
  }

  function updatePost(Request $request, string $id){
    $post = Post::find($id);

    if (!$post) {
      return response()->json(['error' => 'Post not found']);
    }

    $validated = $request -> validate([
      'userId' => 'required|int',
      'title' => 'sometimes|min:3',
      'content' => 'sometimes|min:10'
    ]);

    if($post->author_id !== $validated['userId']){
      return response()->json(['error' => 'You are not the author of this post']);
    }

   $post->title = $validated['title'] ?? $post->title;
   $post->content = $validated['content'] ?? $post->content;

   $post->save();

    return response()->json([$post]);
  }

  function deletePost(string $id){
    $post = Post::find($id);

    if(!$post) {
      return response()->json(['error' => 'Post not found'])->setStatusCode(404, 'Not Found');
    }

    $post->delete();

    return response()->json(['message' => 'Post Deleted']);
  }
}