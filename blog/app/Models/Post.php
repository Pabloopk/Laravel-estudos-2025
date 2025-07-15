<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    protected $fillable = [
        'slug',
        'authorId',
        'title',
        'content',
        'cover',
        'status',
    ];

  public function author(): BelongsTo
  {
      return $this->belongsTo(User::class, 'authorId');
  }
}
