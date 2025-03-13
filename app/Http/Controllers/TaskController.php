<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return ResponseHelper::sendResponse($tasks, 'Task retrieved successfully', 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed' => 'boolean',
            'name' => 'required|string'
        ]);

        $task = Task::create($validatedData);
        return ResponseHelper::sendResponse($task, 'Task created successfully', 201);
    }

    public function show(Task $task)
    {
        return ResponseHelper::sendResponse($task, 'Success', 200);
    }

    public function updateStatus($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return ResponseHelper::sendError('Task not found', [], 404);
        }

        // Toggle nilai completed
        $task->update(['completed' => !$task->completed]);

        return ResponseHelper::sendResponse($task, 'Task status toggled successfully', 200);
    }


    public function deleteSingleTask(Task $task)
    {
        $task->delete();
        return ResponseHelper::sendResponse(null, 'Task deleted successfully', 200);
    }


}
