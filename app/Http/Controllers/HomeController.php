<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Story;
use App\Models\Subscriber;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\Memory;

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
    
    public function subscribe(Request $request)
    {
        $subscribe=new Subscriber;
        $subscribe->email=$request->email;
        $subscribe->save();
    }

    public function getGallery()
    {
        $gallery=Gallery::take(6)->get();
        return response()->json($gallery);
    }
    public function getMemories()
    {
        $memory=Memory::get();
        return response()->json($memory);
    }
    public function getProjects(Request $request)
    {
        $project=null;
        if($request->type=='All'){
            $project=Project::all();
        }else{
            $project=Project::where('status',$request->type)->get();
        }
        
        return response()->json($project);
    }
    
}
