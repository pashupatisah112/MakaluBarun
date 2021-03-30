<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Project;
use App\Models\Story;
use App\Models\Subscriber;
use App\Models\Team;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function getDashboardDetail()
    {
        $story_count=Story::count();
        $project_count=Project::count();
        $team_count=Team::count();
        $slider_count=Slider::count();
        $message_count=Messages::count();
        $subscriber_count=Subscriber::count();
        return response()->json(['story'=>$story_count,'project'=>$project_count,'team'=>$team_count,'slider'=>$slider_count,'message'=>$message_count,'subscribe'=>$subscriber_count]);
    }
    public function getAdmin()
    {
        return response()->json(Auth::user());
    }
    public function changePassword(Request $request)
    {
         $pwd=Auth::user()->getAuthPassword();
         if(Hash::check($request->old,$pwd)){
             $user=User::where('username',$request->user)->first();
             $user->password=Hash::make($request->new);
             $user->save();
             return true;
         }else{
             return false;
         }
    }
}
