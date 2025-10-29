<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Response;

class PostCommentApiController extends Controller
{
    public function __invoke($postId): \Illuminate\Http\JsonResponse
    {
        try {
            $offset = request()->get('offset', 0);
            $limit = request()->get('limit', 5);

            $data = Comment::query()
                ->where(['commentable_type' => Post::class, 'commentable_id' => $postId])
                ->with('user:id,name,avatar')
                ->offset($offset)
                ->limit($limit)
                ->get()
                ->map(function ($comment) {
                    $avatar = $comment->user->avatar ? asset('img/profile/' . $comment->user->avatar) : asset('img/avatar.jpg');
                    return [
                        'id' => $comment->id,
                        'body' => $comment->body,
                        'commented_by' => $comment->user->name,
                        'commented_by_avatar' => $avatar,
                        'is_liked' => $comment->likes()->where('user_id', auth()->id())->exists(),
                        'like_count' => $comment->likes()->count(),
                        'created_at' => $comment->created_at,
                    ];
                });

            return response()->json(
                [
                    'data' => $data,
                    'status' => 'success',
                    'message' => 'Comments retrieved successfully',
                ],
                Response::HTTP_OK,
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }
}
