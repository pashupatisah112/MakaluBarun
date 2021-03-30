<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;

class HomeController extends Controller
{
    public function recordMessage(Request $request)
    {
        $message=new Messages;
        $message->name=$request->name;
        $message->email=$request->email;
        $message->message=$request->message;
        $message->save();
    }
}
