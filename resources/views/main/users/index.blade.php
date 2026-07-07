@extends('main.layout')
@section('title')
    Users
@endsection
@section('main')
    <div class="text-center  text-primary fw-bold">
        <h1><i class="fa-solid fa-users me-2"></i> All Users</h1>
    </div>
    <div>
        <a href="{{ route('users.create') }}" class="btn btn-primary px-3 mb-4">Create User</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 fs-5">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span
                                class="badge bg-info-subtle text-info-emphasis text-capitalize fs-6">{{ $user->role }}</span>
                        </td>
                        <td class="text-capitalize">{{ $user->gender }}</td>
                        <td>
                            <span
                                class="badge bg-{{ $user->is_active == 1 ? 'success' : 'danger' }}-subtle text-{{ $user->is_active == 1 ? 'success' : 'danger' }}-emphasis fs-6">
                                <i class="fa-solid fa-circle-check me-1"></i>
                                {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn btn-secondary" title="Deactivate">
                                    <i class="fa-solid fa-toggle-off"></i>
                                </button>
                                <button class="btn btn btn-dark" title="Deactivate">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn btn-primary" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn btn-danger" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
