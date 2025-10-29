<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Notifications\NewCommentNotification;

class PostCommentController extends Controller
{
    //all comments by post id
    public function index($postId)
    {
        try {
            $post = Post::findOrFail($postId);
            $comments = $post->comments()->with('user')->latest()->get();
            return response()->json([
                'status' => 'success',
                'data' => $comments,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'. $e->getMessage(),
            ]);
        }
    }

    //store comment
    public function store(CommentRequest $request, $postId)
    {
        try {
            $post = Post::findOrFail($postId);
            $comment = $post->comments()->create([
                'user_id' => auth()->user()->id,
                'body' => $request->body,
            ]);

            //send notification
            $post->user->notify(new NewCommentNotification($comment));
            $comment->load('user');
            $avatar = $comment->user->avatar ? asset('img/profile/' . $comment->user->avatar) : asset('img/avatar.jpg');

            $commentData = [
                'id' => $comment->id,
                'body' => $comment->body,
                'commented_by' => $comment->user->name,
                'commented_by_avatar' => $avatar,
                'is_liked' => $comment->likes()->where('user_id', auth()->id())->exists(),
                'like_count' => $comment->likes()->count(),
                'created_at' => $comment->created_at,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $commentData  ,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'. $e->getMessage(),
            ]);
        }
    }

    //update comment
    public function update(CommentRequest $request, $id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->update([
                'body' => $request->body,
            ]);
            $comment = $comment->load('user');
            return response()->json([
                'status' => 'success',
                'data' => $comment,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'. $e->getMessage(),
            ]);
        }
    }

    //delete comment
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Comment deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'. $e->getMessage(),
            ]);
        }
    }
}
