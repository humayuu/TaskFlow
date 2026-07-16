@extends('main.layout')
@section('title')
    Change Password
@endsection
@section('main')
    <div class="text-center text-primary fw-bold">
        <h1><i class="fa-solid fa-key me-2"></i> Change Password</h1>
    </div>
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary px-3 mb-4">
            <i class="fa-solid fa-left-long me-1"></i> Back
        </a>
    </div>

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Password updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <form method="POST" action="{{ route('user-password.update') }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mx-auto">

                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="password" name="current_password"
                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autofocus>
                    @error('current_password', 'updatePassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password"
                        class="form-control @error('password', 'updatePassword') is-invalid @enderror">
                    @error('password', 'updatePassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-check me-1"></i> Update
                    </button>
                    <button type="reset" class="btn btn-outline-secondary px-4">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
