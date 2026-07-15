@extends('main.layout')
@section('title')
    Dashboard
@endsection

@section('main')
    <h1 class="mb-4">{{ Str::upper(Auth::user()->role) }} - Dashboard</h1>

    <h6 class="text-muted text-uppercase mb-2">Task Overview</h6>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-5 border-start border-dark border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-1">Pending Tasks</h6>
                            <h2 class="mb-0">{{ $pendingTask }}</h2>
                        </div>
                        <i class="fas fa-clock fa-2x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-5 border-start border-info border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-1">In Progress</h6>
                            <h2 class="mb-0">{{ $inProgressTask }}</h2>
                        </div>
                        <i class="fas fa-spinner fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-5 border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-1">Completed</h6>
                            <h2 class="mb-0">{{ $completeTask }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-5 border-start border-danger border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-1">Due</h6>
                            <h2 class="mb-0">{{ $dueTask }}</h2>
                        </div>
                        <i class="fa-solid fa-alarm-clock fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if (Auth::user()->role === 'admin')
        <h6 class="text-muted text-uppercase mb-2 mt-4">User Overview</h6>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-5 border-start border-dark border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted text-uppercase mb-1">Total Admins</h6>
                                <h2 class="mb-0">{{ $admins }}</h2>
                            </div>
                            <i class="fas fa-user-shield fa-2x text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-5 border-start border-info border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted text-uppercase mb-1">Total Managers</h6>
                                <h2 class="mb-0">{{ $managers }}</h2>
                            </div>
                            <i class="fas fa-user-tie fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-5 border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted text-uppercase mb-1">Total Employees</h6>
                                <h2 class="mb-0">{{ $employees }}</h2>
                            </div>
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <h6 class="text-muted text-uppercase mb-2 mt-4">Latest Assigned Task Overview</h6>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-5 border-start border-dark border-4">
                <div class="card-body">
                    <table class="table table-hover align-middle mb-0 fs-5">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Assigned To</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestTask as $task)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ Str::substr($task->description, 0, 20) . '....' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="fw-bold">
                                        {{ $task->user->first_name . ' ' . $task->user->last_name . ' (' . ucfirst($task->user->role) . ')' }}
                                    </td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'danger',
                                            'in_progress' => 'warning',
                                            'completed' => 'success',
                                        ];
                                    @endphp
                                    <td class="text-{{ $statusColors[$task->status] ?? 'secondary' }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('task.show', $task->id) }}" class="btn btn btn-dark"
                                                title="Deactivate">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('task.edit', $task->id) }}" class="btn btn btn-primary"
                                                title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <form method="POST" action="{{ route('task.destroy', $task->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn btn-danger" title="Delete"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
