<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms(Request $request) 
    {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId) 
    {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    
    public function newMessage(Request $request, $roomId)
    {
        $newMesasge = new ChatMessage();
        $newMesasge->user_id = Auth::id();
        $newMesasge->room_id = $roomId;
        $newMesasge->message = $request->message;
        $newMesasge->save();

        return $newMesasge;
    }
}
