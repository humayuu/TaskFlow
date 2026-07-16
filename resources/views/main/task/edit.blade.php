@extends('main.layout')
@section('title')
    Edit Task
@endsection
@section('main')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="text-primary fw-bold mb-0">
            <i class="fa-solid fa-list-check me-2"></i>
            {{ Auth::user()->role == 'admin' ? 'Edit Task' : 'Update Task Status' }}
        </h1>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary px-3">
            <i class="fa-solid fa-left-long me-1"></i> Back
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    @if (Auth::user()->role == 'admin')
        <form method="POST" action="{{ route('task.update', $task->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="user_id" class="form-label d-flex align-items-center gap-1">
                            <i class="fa-solid fa-user-tag text-muted"></i>
                            <span>Assigned To</span>
                            <span class="text-danger">*</span>
                        </label>

                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            <option value="" selected disabled>Select a user...</option>

                            @forelse ($users as $user)
                                <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : null }}>
                                    {{ $user->first_name }} {{ $user->last_name }} ({{ ucwords($user->role) }})
                                </option>
                            @empty
                                <option disabled>No users available</option>
                            @endforelse
                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="fa-solid fa-heading me-1"></i> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title') ? old('title') : $task->title }}"
                            placeholder="Enter task title">
                        @error('title')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fa-solid fa-align-left me-1"></i> Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3" placeholder="Optional details about this task">{{ old('description') ? old('description') : $task->description }}</textarea>
                        @error('description')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">
                            <i class="fa-solid fa-calendar-day me-1"></i> Due Date
                        </label>
                        <input type="date" id="due_date" class="form-control @error('due_date') is-invalid @enderror"
                            name="due_date" value="{{ old('due_date') ? old('due_date') : $task->due_date }}">
                        @error('due_date')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-check me-1"></i> Update
                </button>
                <button type="reset" class="btn btn-outline-secondary px-4">
                    <i class="fa-solid fa-rotate-left me-1"></i> Reset
                </button>
                <a href="{{ route('task.index') }}" class="btn btn-outline-danger px-4">
                    <i class="fa-solid fa-xmark me-1"></i> Cancel
                </a>
            </div>
        </form>
    @else
        <form method="POST" action="{{ route('task.update.status', $task->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="mb-3">
                        <label for="status" class="form-label d-flex align-items-center gap-1">
                            <i class="fa-solid fa-user-tag text-muted"></i>
                            <span>Update Task Status</span>
                            <span class="text-danger">*</span>
                        </label>

                        <select {{ Auth::user()->role !== 'admin' ? '' : 'disabled' }}
                            class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="" selected disabled>Open this select menu</option>
                            <option value="in_progress" {{ old('role') == 'in_progress' ? 'selected' : '' }}>In Progress
                            </option>
                            <option value="complete" {{ old('role') == 'complete' ? 'selected' : '' }}>Complete</option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2 mt-5">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-check me-1"></i> Update
                        </button>
                        <a href="{{ route('task.index') }}" class="btn btn-outline-danger px-4">
                            <i class="fa-solid fa-xmark me-1"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
