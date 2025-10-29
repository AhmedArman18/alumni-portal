<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaticDataForHomePageApiController extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        try {
            $data['user'] = [
                'id' => auth()->user()->id ?? null,
                'name' => auth()->user()->name ?? null,
                'email' => auth()->user()->email ?? null,
                'role_id' => auth()->user()->role_id ?? null,
                'avatar' => getProfilePicture() ?? null,
            ];

            return response()->json(
                [
                    'data' => $data,
                    'status' => 'success',
                    'message' => 'Static data retrieved successfully',
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
