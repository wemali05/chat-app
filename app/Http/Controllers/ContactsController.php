<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Events\NewMessege;


use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function get()
    {
        //get all users except the authenticated ones
        $contacts = User::where('id', '!=', auth()->id())->get();

        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();
            
        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            
            return $contact;
        });

        return response()->json($contacts);
    }
    
    public function getMessagesFor($id)
    {
        // $messeges = Message::where('from', $id)->orWhere('to', $id)->get();,
         Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);


        // get all messages between the authenticated user and the selected user
        $messeges = Message::where(function ($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
        ->get();


        return response()->json($messeges);
    }

    public function send(Request $request)
    {
        $messege = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
            ]);

        broadcast(new NewMessege($messege));

        return response()->json($messege);
    }
}
