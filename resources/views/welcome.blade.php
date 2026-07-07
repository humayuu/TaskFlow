@extends('layout')
@section('title')
    Welcome
@endsection
@section('main')
    <div class="text-center py-3">
        <i class="fa-solid fa-clipboard-check text-primary" style="font-size: 3rem;"></i>
        <h1 class="fw-bold text-dark mt-3 mb-2">TaskFlow</h1>
        <p class="text-muted mb-4">Organize your work, stay on track, get things done.</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 rounded-pill">
            Click here to login
        </a>
    </div>
@endsection
