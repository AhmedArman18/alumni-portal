<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeletePostApiController extends Controller
{
    public function __invoke($id): \Illuminate\Http\JsonResponse
    {
        try {
            $post = Post::query()
                ->where('user_id', auth()->user()->id)
                ->findOrFail($id);

            foreach($post->comments as $comment) {
                $comment->likes()->delete();
                $comment->delete();
            }
            $post->comments()->delete();
            $post->likes()->delete();
            foreach($post->images as $image)
            {
                if (file_exists(public_path($image->path))) {
                    unlink(public_path($image->path));
                }
                $image->delete();
            }
            $post->delete();


            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Post deleted successfully',
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
