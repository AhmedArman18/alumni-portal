<?php

namespace App\Http\Controllers;

class ImageDeleteApiController extends Controller
{
    public function __invoke($imageId)
    {
        $image = \App\Models\Image::find($imageId);
        $image ? $image->delete() : null;
        return response()->json([
            'message' => 'Image deleted successfully'
        ]);
    }
}
