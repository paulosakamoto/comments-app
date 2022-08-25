<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller {

  public function index(){
    return Comment::whereNull('parent_id')
      ->get();
  }

  public function store(Request $request){
    $data = $this->validate($request, [
      'parent_id' => 'nullable|int',
      'comment' => 'required|string',
    ]);

    $comment = Comment::create(array_merge($data, [
      'user_id' => 1,
    ]));
    $comment->load(['comments', 'user']);

    return $comment->toArray();
  }
}
