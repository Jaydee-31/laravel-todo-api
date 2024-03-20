<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        $todo = Todo::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'status' => $request['status'],
            'user_id' => $request['user_id'],
        ]);
        return new TodoResource($todo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());
        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->noContent();
    }
}
