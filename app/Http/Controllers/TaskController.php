<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(
            Task::query()
                ->with('categories')
                ->get()
        );
    }

    public function store(TaskStoreRequest $request): TaskResource
    {
        $task = Task::create($request->only('name'));
        $task->categories()->attach($request->input('categories'));

        return new TaskResource($task);
    }

    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
