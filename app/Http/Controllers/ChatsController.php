<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

use App\Events\MessageSent;

class ChatsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function fetchMessage() {
        
        $messages = Message::where('from_id', '=', auth()->user()->id)
        ->orWhere('to_id', '=', auth()->user()->id)
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json([
            'messages' => $messages,
            'success' => true
        ]);
    }

    public function fetchAdminMessage($id) {
        $messages = Message::where('from_id', '=', $id)
        ->orWhere('to_id', '=', $id)
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json([
            'messages' => $messages,
            'success' => true
        ]);
    }

    public function sendMessage() {
        $message = new Message();
        $message->from_id = request()->from_id ? request()->from_id : auth()->user()->id;
        $message->to_id = request()->to_id;
        $message->message = request()->message;
        $message->save();

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'messages' => $message,
            'success' => true
        ]);
    }
}
