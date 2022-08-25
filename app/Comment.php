<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'parent_id',
    'comment',
    'user_id'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function parentComment()
  {
    return $this->belongsTo(Comment::class, 'parent_id', 'id');
  }

  public function comments()
  {
    return $this->hasMany(Comment::class, 'parent_id', 'id');
  }
}
