<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Story;
use App\Models\Subscriber;
use App\Models\Team;

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
    public function getSliders()
    {
        $slide=Slider::all();
        return response()->json($slide);
    }
    public function getRecentProjects()
    {
        $project=Project::where('status','Finished')->take(4)->get();
        return response()->json($project);
    }
    public function getProjectDetail(Request $request)
    {
        $project=Project::where('id',$request->id)->first();
        return response()->json($project);
    }
    public function getRecentBlogs()
    {
        $story=Story::take(3)->get();
        return response()->json($story);
    }
    public function getBlogDetails(Request $request)
    {
        $story=Story::where('id',$request->id)->first();
        return response()->json($story);
    }
    public function subscribe(Request $request)
    {
        $subscribe=new Subscriber;
        $subscribe->email=$request->email;
        $subscribe->save();
    }
    
        public function myBlogs(Request $request){
            $items=$request->per_page;
            $blogs=Story::paginate(8);
            return response()->json($blogs);
            
        }
        public function getProjects()
        {
            $project=Project::all();
            return response()->json($project);
        }
        public function getTeams()
        {
            $team=Team::all();
            return response()->json($team);
        }
    
}
