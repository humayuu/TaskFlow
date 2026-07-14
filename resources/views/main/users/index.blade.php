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

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <form method="GET" action="{{ route('users.index') }}">
        <div class="col-2 mb-3">
            <select class="form-select" name="status" onchange="this.form.submit()">
                <option value="" {{ request('status') === null ? 'selected' : '' }}>All Users</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <noscript><button type="submit">Filter</button></noscript>
    </form>
    <div class="table-responsive">
        @if ($users->count() > 0)
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
                                    <a href="{{ route('users.status.update', $user->id) }}"
                                        class="btn btn btn-{{ $user->is_active == 1 ? 'success' : 'secondary' }}"
                                        title="Deactivate">
                                        <i class="fa-solid fa-toggle-{{ $user->is_active == 1 ? 'on' : 'off' }}"></i>
                                    </a>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn btn-dark"
                                        title="Deactivate">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn btn-primary"
                                        title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
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
            <div class="alert alert-danger">No User Found!</div>
        @endif
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
