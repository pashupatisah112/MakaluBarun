<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery=Gallery::all();
        return response()->json($gallery);
    }
    public function store(Request $request)
    {
        $gallery=new Gallery;
        $gallery->tag=$request->tag;
        $gallery->save();
        return response()->json($gallery);
    }
    public function delete($id)
    {
        $gallery=Gallery::where('id',$id)->first();
        Storage::disk('public')->delete($gallery['image']);
        $gallery->delete();
    }
    public function addGalleryImage(Request $request)
    {
        $path = $request->selectedFile->store('galleryImages');
        $gallery=Gallery::where('id',$request->id)->first();
        $gallery->image=$path;
        $gallery->save();
        return response()->json($gallery);
    }
   
}
