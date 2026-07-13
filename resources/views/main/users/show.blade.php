@extends('main.layout')
@section('title')
    Users
@endsection
@section('main')
    <div class="col-6 mx-auto">
        <h1 class="text-center fw-bold mb-3 text-primary">User information</h1>
        <ul class="list-group">
            <li class="list-group-item">Fullname: <span
                    class="fw-bold">{{ $user->first_name . ' ' . $user->last_name }}</span>
            </li>
            <li class="list-group-item">Email: <span class="fw-bold">{{ $user->email }}</span>
            </li>
            <li class="list-group-item">Role: <span class="fw-bold">{{ $user->role }}</span>
            </li>
            <li class="list-group-item">Status: <span
                    class="fw-bold">{{ $user->is_active == 1 ? 'Active' : 'Inactive' }}</span>
            </li>
            </li>
        </ul>
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-primary px-3 mt-3">
                <i class="fa-solid fa-left-long me-1"></i> Back
            </a>
        </div>
    </div>
@endsection
