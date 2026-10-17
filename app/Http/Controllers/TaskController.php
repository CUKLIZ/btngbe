<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return response([
        //     [
        //         "id" => 1,
        //         "title" => "Belajar Laravel",
        //         "description" => "Belajar Laravel itu menyenangkan",
        //         "completed" => false
        //     ],
        //     [
        //         "id" => 2,
        //         "title" => "Belajar React",
        //         "description" => "Belajar React itu menyenangkan",
        //         "completed" => true
        //     ]
        // ]);

        $tasks = Task::all();

        return response()->json([
            'message' => 'Daftar semua task',
            'data' => TaskResource::collection($tasks),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task = Task::create($validated);

        return response()->json([
            'message' => 'Task Berhasil Di Buat',
            'data' => new TaskResource($task),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json(['message' => 'Task tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Task berhasil ditampilkan',
            'data' => new TaskResource($task),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Task Berhasil Di Update',
            'data' => new TaskResource($task),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
