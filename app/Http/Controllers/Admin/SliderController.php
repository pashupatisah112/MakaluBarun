<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $slide=Slider::all();
        return response()->json($slide);
    }
    public function store(Request $request)
    {
        $slide=new Slider;
        $slide->title=$request->title;
        $slide->tag=$request->tag;
        $slide->save();
        return response()->json($slide);
    }
    public function update(Request $request,$id)
    {
        $slide=Slider::find($id);
        $slide->title=$request->title;
        $slide->tag=$request->tag;
        $slide->save();
        return response()->json($slide);
    }
    public function delete($id)
    {
        Slider::find($id)->delete();
    }
    public function addSliderImage(Request $request)
    {
        $path = $request->selectedFile->store('slider');
        $slider=Slider::where('id',$request->id)->first();
        $slider->image=$path;
        $slider->save();
        return response()->json($slider);
    }
    public function changeSliderImage(Request $request)
    {
        $path = $request->selectedFile->store('slider');
        $slide=Slider::where('id',$request->id)->first();
        Storage::disk('public')->delete($slide['image']);
        $slide->image=$path;
        $slide->save();
        return response()->json($slide);
    }
}
