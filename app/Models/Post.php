<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    // use CommonGlobal;

    protected $fillable = [
        'user_id',
        'content',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];

    const PRIVACY = [
        1 => 'Public',
//        2 => 'Friends',
        3 => 'Only Me',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS['ACTIVE']);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', self::STATUS['INACTIVE']);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function images() {
        return $this->morphMany(Image::class, 'attachable');
    }
}
