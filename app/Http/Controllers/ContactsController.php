<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function get()
    {
        $contacts = User::all();

        return response()->json($contacts);
    }
    
    public function getMessagesFor($id)
    {
        $messeges = Message::where('from', $id)->orWhere('to', $id)->get();

        return response()->json($messeges);
    }

    public function send(Request $request)
    {
        $messege = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
            ]);

            return response()->json($messege);
    }
}
