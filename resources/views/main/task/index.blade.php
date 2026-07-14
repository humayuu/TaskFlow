@extends('main.layout')
@section('title')
    Tasks
@endsection
@section('main')
    <div class="text-center  text-primary fw-bold">
        <h1><i class="fa-solid fa-users me-2"></i> All Task</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-2 mb-3">
        <select class="form-select" aria-label="Default select example">
            <option selected disabled>Open to Filter</option>
            <option value="1">Pending</option>
            <option value="2">Complete</option>
            <option value="3">In Progress</option>
            <option value="3">Due</option>
        </select>
    </div>

    <div class="table-responsive">
        @if ($allTask->count() > 0)
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
                    @foreach ($allTask as $task)
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
        @else
            <div class="alert alert-danger">No Task Found!</div>
        @endif
        <div class="mt-3">
            {{ $allTask->links() }}
        </div>
    </div>
@endsection
