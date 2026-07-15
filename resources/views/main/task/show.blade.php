@extends('main.layout')
@section('title')
    Task
@endsection
@section('main')
    <div class="col-6 mx-auto">
        <h1 class="text-center fw-bold mb-3 text-primary">Task information</h1>
        <ul class="list-group">
            <li class="list-group-item">Title: <span class="fw-bold">{{ $task->title }}</span>
            </li>
            <li class="list-group-item">Description: <span class="fw-bold">{{ $task->description }}</span>
            </li>
            <li class="list-group-item">Due Date: <span
                    class="fw-bold">{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</span>
            </li>
            <li class="list-group-item">Assigned To: <span class="fw-bold">
                    {{ $task->user->first_name . ' ' . $task->user->last_name . ' (' . ucfirst($task->user->role) . ')' }}
                </span>
            </li>
            @php
                $statusColors = [
                    'pending' => 'danger',
                    'in_progress' => 'warning',
                    'completed' => 'success',
                ];
            @endphp
            <li class="list-group-item">Status: <span
                    class="fw-bold text-{{ $statusColors[$task->status] ?? 'secondary' }}">
                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                </span>
            </li>
            </li>
        </ul>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-primary px-3 mt-3">
                <i class="fa-solid fa-left-long me-1"></i> Back
            </a>
        </div>
    </div>
@endsection
