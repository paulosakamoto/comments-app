<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller {

  public function index(){
    return Comment::with(['comments', 'user'])
      ->whereNull('parent_id')
      ->orderBy('id', 'desc')
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

    return $comment->toArray();
  }
}
