<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class CompleteTaskController extends Controller
{ 
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        if(!$request->id){
            return "Please include a valid id";
        }
        

        $query = Task::where('id', $request->id)->get();
        $query->toQuery()->update(['name'=>$query->name, 'is_completed'=> $request->is_completed]);


        return TaskResource::collection(Task::all());
    }
}
