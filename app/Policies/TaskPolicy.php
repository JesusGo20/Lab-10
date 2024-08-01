<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{



    public function autorized(User $user, Task $task): Response
    {
        return $task->user->is($user)
            ? Response::allow()
            : Response::deny('No estás autorizado para realizar esta acción');
    }
}
