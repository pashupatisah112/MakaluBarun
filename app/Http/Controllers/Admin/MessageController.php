<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function myMessages(Request $request){
        $items=$request->per_page;
        $messages=Messages::paginate($items);
        return response()->json($messages);
        
    }
    public function delete($id)
    {
        Messages::find($id)->delete();
    }
}
