<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/task', [ApiController::class, 'showTask']);

Route::get('/users/{user}/tasks', [ApiController::class, 'showTaskUser'])->middleware('auth:sanctum');


Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

Route::put('/tasks/{task}', [ApiController::class, 'updateTask'])->middleware('auth:sanctum');
Route::delete('/delete/{task}', [ApiController::class, 'delete'])->middleware('auth:sanctum');
