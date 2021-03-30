<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function myTeams(Request $request){
        $items=$request->per_page;
        $team=Team::paginate($items);
        return response()->json($team);
        
    }
    public function store(Request $request)
    {
         $team=new Team;
         $team->fname=$request->fname;
         $team->lname=$request->lname;
         $team->position=$request->position;
         $team->phone=$request->phone;
         $team->email=$request->email;
         $team->fb_link=$request->fb_link;
         $team->insta_link=$request->insta_link;
         $team->twitter_link=$request->twitter_link;
         $team->about=$request->about;
         $team->save();
         return response()->json($team);

    }
    public function update(Request $request,$id)
    {
        $team=Team::find($id);
        $team->fname=$request->fname;
        $team->lname=$request->lname;
        $team->position=$request->position;
        $team->phone=$request->phone;
        $team->email=$request->email;
        $team->fb_link=$request->fb_link;
        $team->insta_link=$request->insta_link;
        $team->twitter_link=$request->twitter_link;
        $team->about=$request->about;
        $team->save();
        return response()->json($team);
    }
    public function delete($id)
    {
        Team::find($id)->delete();
    }
    public function addTeamImage(Request $request)
    {
        $path = $request->selectedFile->store('teamImages');
        $team=Team::where('id',$request->id)->first();
        $team->image=$path;
        $team->save();
        return response()->json($team);
    }
    public function changeTeamImage(Request $request)
    {
        $path = $request->selectedFile->store('teamImages');
        $team=Team::where('id',$request->id)->first();
        Storage::disk('public')->delete($team['image']);
        $team->image=$path;
        $team->save();
        return response()->json($team);
    }
}
