<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * For Dashboard Data
     */
    public function dashboard()
    {
        if (Auth::user()->role == "admin") {
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
            $latestTask = Task::whereDate("created_at", today())->paginate(5);
            return view("main.dashboard", compact('pendingTask', 'inProgressTask', 'completeTask', 'dueTask', 'managers', 'admins', 'employees', 'latestTask'));
        } elseif (Auth::user()->role == "employee") {
            // For Task Count
            $pendingTask = Task::where('status', 'pending')->where('user_id', Auth::user()->id)->count();
            $inProgressTask = Task::where('status', 'in_progress')->where('user_id', Auth::user()->id)->count();
            $completeTask = Task::where('status', 'complete')->where('user_id', Auth::user()->id)->count();
            $dueTask = Task::where('status', 'due')->where('user_id', Auth::user()->id)->count();

            $latestTask = Task::whereDate("created_at", today())->where('user_id', Auth::user()->id)->paginate(5);
            return view("main.dashboard", compact('pendingTask', 'inProgressTask', 'completeTask', 'dueTask', 'latestTask'));
        } elseif (Auth::user()->role == "manager") {
            // For Task Count
            $pendingTask = Task::where('status', 'pending')->where('user_id', Auth::user()->id)->count();
            $inProgressTask = Task::where('status', 'in_progress')->where('user_id', Auth::user()->id)->count();
            $completeTask = Task::where('status', 'complete')->where('user_id', Auth::user()->id)->count();
            $dueTask = Task::where('status', 'due')->where('user_id', Auth::user()->id)->count();

            $latestTask = Task::whereDate("created_at", today())->where('user_id', Auth::user()->id)->paginate(5);
            return view("main.dashboard", compact('pendingTask', 'inProgressTask', 'completeTask', 'dueTask', 'latestTask'));
        }
    }
}
