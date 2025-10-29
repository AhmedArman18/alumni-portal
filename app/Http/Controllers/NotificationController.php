<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getUnreadNotifications(Request $request)
    {
        $offset = $request->get('offset') ?? 0;
        // $user = $request->user();
        $notifications = auth()->user()->unreadNotifications()
            ->orderBy('created_at', 'desc')
            // ->offset($offset)
            // ->limit(10)
            ->get();

        return response()->json($notifications);
    }

    public function markAllAsRead(Request $request)
    {
        $user = $request->user();
        $user->unreadNotifications->markAsRead();
        return response()->json(['message' => 'success']);
    }
}
