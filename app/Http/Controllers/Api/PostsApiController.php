<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Response;

class PostsApiController extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        try {
            $posts = Post::query()
                ->with('user:id,name,avatar', 'likes:id,user_id', 'comments:id,user_id,body,created_at', 'images:id,attachable_id,path')
                ->active()
                ->latest()
                ->get();

            $data = $posts->map(function ($post) {
                $avatar = $post->user->avatar ? asset('img/profile/' . $post->user->avatar) : asset('img/avatar.jpg');

                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'author_id' => $post->user->id,
                    'author_name' => $post->user->name,
                    'author_avatar' => $avatar,
                    'privacy_id' => 1,
                    'privacy_name' => 'public',
                    'content' => $post->content,
                    'is_liked' => $post
                        ->likes()
                        ->where('user_id', auth()->id())
                        ->exists(),
                    'like_count' => $post->likes()->count(),
                    'comment_count' => $post->comments()->count(),
                    'comments' => $post
                        ->comments()
                        ->with('user:id,name,avatar', 'replies')
                        ->latest()
                        ->take(1)
                        ->get()
                        ->map(function ($comment) {
                            $avatar = $comment->user->avatar ? asset('img/profile/' . $comment->user->avatar) : asset('img/avatar.jpg');

                            return [
                                'id' => $comment->id,
                                'body' => $comment->body,
                                'commented_by' => $comment->user->name,
                                'commented_by_avatar' => $avatar,
                                'is_liked' => $comment
                                    ->likes()
                                    ->where('user_id', auth()->id())
                                    ->exists(),
                                'like_count' => $comment->likes()->count(),
                                'created_at' => $comment->created_at,
                            ];
                        }),
                    'images' => $post->images->map(function ($image) {
                        return [
                            'id' => $image->id,
                            'image_url' => asset($image->path),
                        ];
                    }),
                    'created_at' => $post->created_at->diffForHumans(),
                    'updated_at' => $post->updated_at,
                ];
            });

            return response()->json(
                [
                    'data' => $data,
                    'status' => 'success',
                    'message' => 'Posts retrieved successfully',
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
