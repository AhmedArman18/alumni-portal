<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewLikeNotification;

class LikeController extends Controller
{
    public function likeInsertDeleteToPost(Post $post)
    {
        // try {
            $like = $post->likes()->where('user_id', auth()->id())->first();
            if ($like) {
                $like->delete();
                $data['is_liked'] = false;
            } else {
                $this->like($post, Post::class);
                $data['is_liked'] = true;
            }
            $data['like_count'] = $post->likes()->count();

            return response()->json($data, 200);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Error'
        //     ]);
        // }
    }

    public function likeInsertDeleteToComment($commentId)
    {
        try {
            $comment = Comment::findOrFail($commentId);
            $like = $comment->likes()->where('user_id', auth()->id())->first();
            if ($like) {
                $like->delete();
                $data['is_liked'] = false;
            } else {
                $this->like($comment, Comment::class);
                $data['is_liked'] = true;
            }
            $data['like_count'] = $comment->likes()->count();

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error'.$e->getMessage(),
            ]);
        }
    }

    public function like($model, $likableType)
    {
        $like = $model->likes()->create([
            'user_id' => auth()->id(),
            'likeable_id' => $model->id,
            'likeable_type' => $likableType,
            'like' => 1
        ]);

        $model->user->notify(new NewLikeNotification($like, $likableType));
    }

    // public function dislike($id)
    // {
    //     $post = Post::findOrFail($id);
    //     $post->likes()->create([
    //         'user_id' => auth()->id(),
    //         'like' => 0
    //     ]);

    //     return redirect()->back();
    // }
}
