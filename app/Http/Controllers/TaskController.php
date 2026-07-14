<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTask = Task::with('user')
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('main.task.index', compact('allTask'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('id', "!=", 1)->where("is_active", 1)->get();
        return view('main.task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        return redirect()->back()->with('success', "Task Created & Assigned Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('user')->findOrFail($id);
        return view('main.task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('is_active', 1)->get();
        return view('main.task.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return redirect()->back()->with('success', 'Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task Deleted Successfully');
    }
}