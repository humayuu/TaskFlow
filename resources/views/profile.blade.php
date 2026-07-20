@extends('main.layout')
@section('title')
    Profile
@endsection
@section('main')
    <div class="text-center text-primary fw-bold">
        <h1><i class="fa-solid fa-key me-2"></i> Update Profile</h1>
    </div>
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary px-3 mb-4">
            <i class="fa-solid fa-left-long me-1"></i> Back
        </a>
    </div>

    @if (session('status') === 'profile-information-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Profile updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <form method="POST" action="{{ route('user-profile-information.update') }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mx-auto">

                <div class="mb-3">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}"
                        class="form-control @error('first_name') is-invalid @enderror" autofocus>
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}"
                        class="form-control @error('last_name') is-invalid @enderror">
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                        class="form-control
                        @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
