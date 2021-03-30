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

    //stories
    Route::post('myStories',[\App\Http\Controllers\Admin\StoryController::class,'myStories']);
    Route::post('stories',[\App\Http\Controllers\Admin\StoryController::class,'store']);
    Route::put('stories/{story}',[\App\Http\Controllers\Admin\StoryController::class,'update']);
    Route::delete('stories/{story}',[\App\Http\Controllers\Admin\StoryController::class,'delete']);
    Route::post('addStoryImage',[\App\Http\Controllers\Admin\StoryController::class,'addStoryImage']);
    Route::post('changeStoryImage',[\App\Http\Controllers\Admin\StoryController::class,'changeStoryImage']);

    //Team
    Route::post('myTeams',[\App\Http\Controllers\Admin\TeamController::class,'myTeams']);
    Route::post('teams',[\App\Http\Controllers\Admin\TeamController::class,'store']);
    Route::put('teams/{team}',[\App\Http\Controllers\Admin\TeamController::class,'update']);
    Route::delete('teams/{team}',[\App\Http\Controllers\Admin\TeamController::class,'delete']);
    Route::post('addTeamImage',[\App\Http\Controllers\Admin\TeamController::class,'addTeamImage']);
    Route::post('changeTeamImage',[\App\Http\Controllers\Admin\TeamController::class,'changeTeamImage']);

});
Route::post('adminLogin',[AuthController::class,'adminLogin']);


