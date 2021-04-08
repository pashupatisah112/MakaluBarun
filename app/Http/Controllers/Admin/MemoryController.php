<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;
use Illuminate\Support\Facades\Storage;

class MemoryController extends Controller
{
    public function index()
    {
        $memory=Memory::all();
        return response()->json($memory);
    }
    public function store(Request $request)
    {
        $memory=new Memory;
        $memory->tag=$request->tag;
        $memory->save();
        return response()->json($memory);
    }
    public function delete($id)
    {
        $memory=Memory::where('id',$id)->first();
        Storage::disk('public')->delete($memory['image']);
        $memory->delete();
    }
    public function addMemoryImage(Request $request)
    {
        $path = $request->selectedFile->store('memoryImages');
        $memory=Memory::where('id',$request->id)->first();
        $memory->image=$path;
        $memory->save();
        return response()->json($memory);
    }
}
