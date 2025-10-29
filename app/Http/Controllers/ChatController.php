<?php


namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::where('id', '!=', Auth::id())->get();
        return view('chat.index', compact('users'));
    }

    public function fetchMessages($id)
    {
        return Message::where(function ($q) use ($id) {
            $q->where('from_id', Auth::id())->where('to_id', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('from_id', $id)->where('to_id', Auth::id());
        })->get();
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'from_id' => Auth::id(),
            'to_id' => $request->to_id,
            'body' => $request->body,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }
}

