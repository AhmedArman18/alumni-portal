<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
        'like'
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function likedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLiked($query)
    {
        return $query->where('like', 1);
    }
}
