<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function mySubscribers(Request $request){
        $items=$request->per_page;
        $subscribers=Subscriber::paginate($items);
        return response()->json($subscribers);
        
    }
}
