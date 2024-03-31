<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TaskResource::collection(Task::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $taska = new Task;
        $taska->name = $request->name;
        $taska->is_completed = $request->is_completed;
        $taska->save();
     

        return redirect("api/v1/fame");
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $query = Task::query();
       $model = $query->where('id',$id)->get();

       return TaskResource::make($model[0]);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if(!$request->id){
            return "Please include a valid id";
        }
        

        $query = Task::where('id', $request->id)->get();
        $query->toQuery()->update(['name'=>$request->name, 'is_completed'=> $request->is_completed]);


        return TaskResource::collection(Task::all());
  
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
