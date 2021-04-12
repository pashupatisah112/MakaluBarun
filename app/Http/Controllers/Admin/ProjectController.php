<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function myProjects(Request $request){
        $items=$request->per_page;
        $products=Project::paginate($items);
        return response()->json($products);
        
    }
    public function store(Request $request)
    {
         $project=new Project;
         $project->title=$request->title;
         $project->start_date=$request->start_date;
         $project->ended_date=$request->ended_date;
         $project->status=$request->status;
         $project->location=$request->location;
         $project->intro=$request->intro;
         $project->detail=$request->detail;
         $project->save();
         return response()->json($project);

    }
    public function update(Request $request,$id)
    {
        $project=Project::find($id);
        $project->title=$request->title;
        $project->start_date=$request->start_date;
        $project->ended_date=$request->ended_date;
        $project->status=$request->status;
        $project->location=$request->location;
        $project->intro=$request->intro;
        $project->detail=$request->detail;
        $project->save();
        return response()->json($project);
    }
    public function delete($id)
    {
        Project::find($id)->delete();
    }
    public function changeStatus(Request $request,$id)
    {
        $project=Project::find($id);
        $project->status=$request->status;
        $project->save();
        return response()->json($project);
    }
    public function addProjectImage(Request $request)
    {
        $path = $request->selectedFile->store('project');
        $project=Project::where('id',$request->id)->first();
        $project->image=$path;
        $project->save();
        return response()->json($project);
    }
    public function changeImage(Request $request)
    {
        $path = $request->selectedFile->store('project');
        $project=Project::where('id',$request->id)->first();
        Storage::disk('public')->delete($project['image']);
        $project->image=$path;
        $project->save();
        return response()->json($project);
    }
}
