<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'status' => 'required'
        ]);

        $data = new Task();
        $data->user_id = $request->user_id;
        $data->title = $request->title;
        $data->body = $request->body;
        $data->status = $request->status;
        $data->save();

        return response()->json($data,201);
    }

    public function destroy(Request $request)
    {
        $task =Task::where('id','=', $request->id)->first();
        if($task->id == $request->id){
            $task->delete();

            return response()->json([
                'success' => 'Your task is deleted successfully.'
            ],200);
        }
        return response()->json([
            'error' => 'Task does not belong to you.'
        ],404);
    }
}
