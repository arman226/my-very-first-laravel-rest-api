<?php

use App\Http\Controllers\Api\v1\TaskController;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::apiResource("/fame", TaskController::class);
    Route::patch("/task/{id}", function($id) {
        $query = Task::where('id', $id)->get();
        $query->toQuery()->update(['is_completed'=> 1]);
        return TaskResource::collection(Task::all());
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
