<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function myStories(Request $request){
        $items=$request->per_page;
        $story=Story::paginate($items);
        return response()->json($story);
        
    }
    public function store(Request $request)
    {
         $story=new Story;
         $story->title=$request->title;
         $story->created_at=$request->created_at;
         $story->detail=$request->detail;
         $story->save();
         return response()->json($story);

    }
    public function update(Request $request,$id)
    {
        $story=Story::find($id);
        $story->title=$request->title;
         $story->created_at=$request->created_at;
         $story->detail=$request->detail;
        $story->save();
        return response()->json($story);
    }
    public function delete($id)
    {
        Story::find($id)->delete();
    }
    public function changeStatus(Request $request,$id)
    {
        $story=Story::find($id);
        $story->status=$request->status;
        $story->save();
        return response()->json($story);
    }
    public function addStoryImage(Request $request)
    {
        $path = $request->selectedFile->store('storyImages');
        $story=Story::where('id',$request->id)->first();
        $story->image=$path;
        $story->save();
        return response()->json($story);
    }
    public function changeStoryImage(Request $request)
    {
        $path = $request->selectedFile->store('storyImages');
        $story=Story::where('id',$request->id)->first();
        Storage::disk('public')->delete($story['image']);
        $story->image=$path;
        $story->save();
        return response()->json($story);
    }
}
