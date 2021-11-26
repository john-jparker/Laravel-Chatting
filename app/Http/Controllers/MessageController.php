<?php

namespace App\Http\Controllers;

use App\Events\NewMessageSendEvent;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())
            ->select('id', 'name')
            ->get();

        $users = $users->sortByDesc('last_message.created_at');
        $users = $users->values()->all();
        $types = Message::MessageType;
        return Inertia::render('Dashboard', compact('users', 'types'));
    }

    public function selected_user_message(Request $request, $userId)
    {
        if (!$request->ajax()){
            return abort(404);
        }
        $update = Message::where('sender_id', $userId)
            ->where('receiver_id', auth()->id())
            ->where('type', Message::Types['Receiver'])
            ->where('read_at', null)
            ->update([
                'read_at'=>now()
            ]);


        $messages = Message::query()->where(function ($query) use ($userId){
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $userId)
                ->where('type', Message::Types['Sender']);
        })->orWhere(function ($query) use ($userId){
            return $query->where('sender_id', $userId)
                ->where('receiver_id', auth()->id())
                ->where('type', Message::Types['Receiver']);
        })->orderby('id', 'desc')
            ->paginate();

        return response()->json([
            'status'=>200,
            'data'=>[
                'messages'=>$messages
            ]
        ]);

    }

    public function send_message(Request $request)
    {
        $senderMessage = Message::create([
            'sender_id'=>auth()->id(),
            'receiver_id'=>$request->user_id,
            'message'=>!empty($request->images)? $request->images: $request->message,
            'type'=>Message::Types['Sender'],
            'message_type'=>$request->message_type,
            'read_at'=>now()
        ]);

        $message = $senderMessage->replicate()->fill([
            'type' => Message::Types['Receiver'],
            'read_at'=>null,
        ]);
        $message->save();

        broadcast(new NewMessageSendEvent($message));
        return response()->json($senderMessage, 200);

    }
}
