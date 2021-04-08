<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProjectController;
use APP\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\TeamController;


Route::group(['middleware'=>['auth:api'],'namespace'=>'Admin'],function(){

    //dashboard
    Route::get('getDashboardDetail',[\App\Http\Controllers\Admin\HomeController::class,'getDashboardDetail']);
    Route::get('getAdmin',[\App\Http\Controllers\Admin\HomeController::class,'getAdmin']);
    Route::post('changePassword',[\App\Http\Controllers\Admin\HomeController::class,'changePassword']);

    //projects
    Route::post('myProjects',[ProjectController::class,'myProjects']);
    Route::post('projects',[ProjectController::class,'store']);
    Route::put('projects/{project}',[ProjectController::class,'update']);
    Route::delete('projects/{project}',[ProjectController::class,'delete']);
    Route::post('changeProjectStatus/{status}',[ProjectController::class,'changeStatus']);
    Route::post('addProjectImage',[ProjectController::class,'addProjectImage']);
    Route::post('changeImage',[ProjectController::class,'changeImage']);

    //Slider
    Route::get('sliders',[\App\Http\Controllers\Admin\SliderController::class,'index']);
    Route::post('sliders',[\App\Http\Controllers\Admin\SliderController::class,'store']);
    Route::put('sliders/{slider}',[\App\Http\Controllers\Admin\SliderController::class,'update']);
    Route::delete('sliders/{slider}',[\App\Http\Controllers\Admin\SliderController::class,'delete']);
    Route::post('addSliderImage',[\App\Http\Controllers\Admin\SliderController::class,'addSliderImage']);
    Route::post('changeSliderImage',[\App\Http\Controllers\Admin\SliderController::class,'changeSliderImage']);

    //Messages
    Route::post('myMessages',[\App\Http\Controllers\Admin\MessageController::class,'myMessages']);
    Route::delete('messages/{message}',[\App\Http\Controllers\Admin\MessageController::class,'delete']);

    //Subscribers
    Route::post('mySubscribers',[\App\Http\Controllers\Admin\SubscriberController::class,'mySubscribers']);

    //Gallery
    Route::get('getImage',[\App\Http\Controllers\Admin\GalleryController::class,'index']);
    Route::post('gallery',[\App\Http\Controllers\Admin\GalleryController::class,'store']);
    Route::delete('gallery/{gallery}',[\App\Http\Controllers\Admin\GalleryController::class,'delete']);
    Route::post('addGalleryImage',[\App\Http\Controllers\Admin\GalleryController::class,'addGalleryImage']);

    //Memory
    Route::get('getImage',[\App\Http\Controllers\Admin\MemoryController::class,'index']);
    Route::post('memory',[\App\Http\Controllers\Admin\MemoryController::class,'store']);
    Route::delete('memory/{memory}',[\App\Http\Controllers\Admin\MemoryController::class,'delete']);
    Route::post('addMemoryImage',[\App\Http\Controllers\Admin\MemoryController::class,'addMemoryImage']);

});
Route::post('recordMessage',[\App\Http\Controllers\HomeController::class,'recordMessage']);
Route::get('getSliders',[\App\Http\Controllers\HomeController::class,'getSliders']);
Route::get('getRecentProjects',[\App\Http\Controllers\HomeController::class,'getRecentProjects']);
Route::post('subscribe',[\App\Http\Controllers\HomeController::class,'subscribe']);
Route::post('getProjectDetail',[\App\Http\Controllers\HomeController::class,'getProjectDetail']);
Route::get('getProjects',[\App\Http\Controllers\HomeController::class,'getProjects']);
Route::get('getGallery',[\App\Http\Controllers\HomeController::class,'getGallery']);
Route::get('getMemories',[\App\Http\Controllers\HomeController::class,'getMemories']);



Route::post('adminLogin',[AuthController::class,'adminLogin']);


