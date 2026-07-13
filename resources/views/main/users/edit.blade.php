@extends('main.layout')
@section('title')
    Edit User
@endsection
@section('main')
    <div class="text-center text-primary fw-bold">
        <h1><i class="fa-solid fa-users me-2"></i> Edit User</h1>
    </div>
    <div>
        <a href="{{ route('users.index') }}" class="btn btn-primary px-3 mb-4">
            <i class="fa-solid fa-left-long me-1"></i> Back
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="mb-3">
                    <label for="first_name" class="form-label">
                        <i class="fa-solid fa-user me-1"></i> First Name
                    </label>
                    <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror"
                        name="first_name" value="{{ old('first_name') ? old('first_name') : $user->first_name }}" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">
                        <i class="fa-solid fa-user me-1"></i> Last Name
                    </label>
                    <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                        name="last_name" value="{{ $user->last_name }}">
                    @error('last_name')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fa-solid fa-envelope me-1"></i> Email
                    </label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $user->email }}">
                    @error('email')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">
                        <i class="fa-solid fa-user-tag me-1"></i> Select Role
                    </label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                        <option value="" selected disabled>Open this select menu</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                    </select>
                    @error('role')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">
                        <i class="fa-solid fa-venus-mars me-1"></i> Select Gender
                    </label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                        <option value="" selected disabled>Open this select menu</option>
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>female</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-check me-1"></i> Update
                    </button>
                    <button type="reset" class="btn btn-dark px-4">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger px-4">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
