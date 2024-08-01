<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    use AuthorizesRequests;
    //
    public function showTask(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TaskResource::collection(Task::all());
    }

    public function showTaskUser(User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TaskResource::collection(Task::where('user_id', $user->id)->get());
    }

    public function updateTask(Task $task, Request $request)
    {

        $this->authorize('autorized', $task);

        $task->update($request->all());
    }

    public function delete(Task $task)
    {
        $this->authorize('autorized', $task);
        $task->delete();
    }
}
