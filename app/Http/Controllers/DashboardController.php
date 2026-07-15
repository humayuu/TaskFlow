<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * For Dashboard Data
     */
    public function dashboard()
    {
        // For Task Count
        $pendingTask = Task::where('status', 'pending')->count();
        $inProgressTask = Task::where('status', 'in_progress')->count();
        $completeTask = Task::where('status', 'complete')->count();
        $dueTask = Task::where('status', 'due')->count();

        // For User Count
        $admins = User::where('role', 'admin')->count();
        $managers = User::where('role', 'manager')->count();
        $employees = User::where('role', 'employee')->count();

        // For Latest Task 
        $latestTask = Task::whereDate("created_at", today())->get();


        return view("main.dashboard", compact('pendingTask', 'inProgressTask', 'completeTask', 'dueTask', 'managers', 'admins', 'employees', 'latestTask'));
    }
}