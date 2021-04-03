<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\Store;
use App\Http\Requests\Task\Update;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TaskController
 * @package App\Http\Controllers\Api
 */
class TaskController extends Controller
{
    /**
     * @var Task
     */
    private $task;

    /**
     * @var UserTask
     */
    private $userTask;
    /**
     * @var Authenticatable|null
     */
    private $user;

    /**
     * TaskController constructor.
     * @param UserTask $userTask
     * @param Task $task
     */
    public function __construct(UserTask $userTask, Task $task)
    {
        $this->userTask = $userTask;
        $this->task = $task;
        $this->user = auth()->guard('api')->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = $this->user->tasks->all();
        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Store $request
     * @return JsonResponse
     */
    public function store(Store $request)
    {
        $task = $this->task->create($request->all());
        $this->userTask->create([
            'user_id' => $this->user->id,
            'task_id' => $task->id
        ]);
        return response()->json($task, 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Update $request, $id)
    {
        $task = $this->user->tasks->where('id', $id)->first();

        if (!$task) {
            $this->returnInvalidTaskResponse();
        }

        $taskUpdated = $task->update($request->all());

        if (!$taskUpdated) {
            $this->returnInvalidTaskResponse();
        }

        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $task = $this->user->tasks->where('id', $id)->first();
        $userTask = $this->userTask
            ->where('task_id', $task->id)
            ->where('user_id', $this->user->id)
            ->first();

        if (!$task || $userTask) {
            $this->returnInvalidTaskResponse();
        }

        $userTask->delete();
        $task->delete();
        return response()->json(['message' => 'Entry removed'], 200);
    }

    /**
     * @return JsonResponse
     */
    private function returnInvalidTaskResponse(): JsonResponse
    {
        return response()->json(['error' => 'Invalid task'], 404);
    }

    /**
     *
     */
    public function create()
    {
        return abort(501);
    }

    /**
     *
     */
    public function show($id)
    {
        return abort(501);
    }

    /**
     *
     */
    public function edit($id)
    {
        return abort(501);
    }
}
