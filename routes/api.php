<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('hello', function () {
    return ['message' => 'Hello World'];
});

Route::post('hello', function () {
    return ['message' => 'Request post berhasil'];
});

Route::get('info', function () {
    return [
        'app' => 'Task API',
        'version' => '1.0',
        'author' => 'Gweh yang keren banget',
    ];
});

Route::apiResource('tasks', TaskController::class);