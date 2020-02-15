<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\User;
use App\Message;
use App\Events\NewMessageEvent;
use App\Http\Controllers\map;


class ContactsController extends Controller
{


    public function get()
    {

        $contacts = User::where('id','!=',auth()->id())->get();

        $unreadIDs=Message::select(\DB::raw('`from` as Sender_id,count(`from`) as message_count'))
        ->where('to',auth()->id())
        ->where('read',false)
        ->groupBy('from')
        ->get();


        $contacts = $contacts->map(function($contact) use ($unreadIDs) {

            $contactUnread = $unreadIDs->where('Sender_id',$contact->id)->first();

            $contact->unread =  $contactUnread ? $contactUnread->message_count : 0 ;

            return $contact;
        });
        //dd($unreadIDs);

        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
        //mark all messages with the selected contact as read
        Message::where('from',$id)
        ->where ('to',auth()->id())
        -> update(['read'=> true]);


        
       // $messages=Message :: where ('from',$id)->orwhere('to',$id) ->get();
        $messages=Message :: where (function($q) use ($id){
            $q->where('from',auth()->id());
            $q->where('to',$id);
        })-> orWhere(function($q) use ($id){
            $q->where('from',$id);
            $q->where('to',auth()->id());
        })
        ->get();


        return response()->json($messages);
    }


    public function send(Request $request)
    {
        $message = Message::create ([
            'from'=> auth()->id(),
            'to'=>$request->contact_id,
            'text'=>$request->text
        ]);
        broadcast(new NewMessageEvent($message));
        return response()->json($message);
    }
}
