<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ChatMessageApiController extends Controller
{
    public function __invoke(): JsonResponse
    {
        try {

            $messageCount = ChMessage::query()
                ->where('to_id',auth()->user()->id)
                ->where('seen', ChMessage::MESSAGE_NOT_SEEN)
                ->count();

            return response()->json(
                [
                    'data' => $messageCount,
                    'status' => 'success',
                    'message' => 'Messages retrieved successfully',
                ],
                ResponseAlias::HTTP_OK,
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }
}
