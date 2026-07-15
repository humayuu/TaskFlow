<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role == 'employee' || Auth::user()->role == 'manager') {
            $query = Task::with('user')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC');
        } else {
            $query = Task::with('user')->orderBy('id', 'DESC');
        }

        if ($request->filled('status')) {
            if ($request->status === 'due') {
                $query->where('due_date', '<', now())
                    ->where('status', '!=', 'complete');
            } else {
                $query->where('status', $request->status);
            }
        }

        $allTask = $query->paginate(5)->withQueryString();

        return view('main.task.index', compact('allTask'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', '!=', 'admin')->where('is_active', 1)->get();
        return view('main.task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        return redirect()->route('task.index')->with('success', 'Task Created & Assigned Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('user')->findOrFail($id);

        abort_if(
            Auth::user()->role !== 'admin' && Auth::user()->id !== $task->user_id,
            403
        );

        return view('main.task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        abort_if(
            Auth::user()->role !== 'admin' && Auth::user()->id !== $task->user_id,
            403
        );

        $users = User::where('is_active', 1)->get();
        return view('main.task.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);

        abort_if(
            Auth::user()->role !== 'admin' && Auth::user()->id !== $task->user_id,
            403
        );

        $task->update($request->validated());
        return redirect()->route('task.index')->with('success', 'Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        abort_if(Auth::user()->role !== 'admin', 403);

        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task Deleted Successfully');
    }
}