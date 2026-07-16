@extends('layout')
@section('title')
    Login
@endsection
@section('main')
    <div>
        <h1 class="text-dark fw-bold text-center mb-2">
            <i class="fa-solid fa-clipboard-check"></i> TaskFlow
        </h1>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}"
                    autofocus placeholder="Enter Email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary px-5">
                    Login <i class="fa-solid fa-right-to-bracket"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
