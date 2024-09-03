<?php

namespace App\Http\Controllers;

use App\Models\UserMessage;
use Illuminate\Http\Request;

class usersMessagesController extends Controller
{
    public function index(){
        $messages = UserMessage::latest()->paginate(5);
        return view('admin.usersMessages.index', compact('messages'));
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email',
            'subject'=>'required|string',
            'message'=>'required|string',
            ]);


            $message = new UserMessage();
            $message->name =strip_tags( $request->name);
            $message->email = strip_tags($request->email);
            $message->subject = strip_tags($request->subject);
            $message->message = strip_tags($request->message);
            $message->save();
            return redirect()->route('contact')->with('success','messsage sent successfully.');
    }

    public function show(UserMessage $message){

        return view('admin.usersMessages.show',compact('message'));
    }
}
