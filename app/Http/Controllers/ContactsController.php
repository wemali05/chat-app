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
}
