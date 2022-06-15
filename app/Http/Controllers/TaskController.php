<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        return Task::query()
                   ->with('categories')
                   ->get();
    }

    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->only('name'));
        $task->categories()->attach($request->input('categories'));
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
