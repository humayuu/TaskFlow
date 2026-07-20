<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- Bootstrap Css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    {{-- Font Awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="d-flex" style="min-height: 100vh;">

        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="fa-solid fa-clipboard-check me-2 fs-4"></i>
                <span class="fs-4 fw-bold">TaskFlow</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link text-white">
                        <i class="fa-solid fa-gauge me-2"></i>
                        Dashboard
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link text-white">
                            <i class="fa-solid fa-users me-2"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('task.create') }}" class="nav-link text-white">
                            <i class="fa-solid fa-square-plus me-2"></i>
                            Create Task
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('task.index') }}" class="nav-link text-white">
                        <i class="fa-solid fa-list-check me-2"></i>
                        All Task
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}&background=random"
                        alt="{{ Auth::user()->first_name }}" width="32" height="32" class="rounded-circle me-2">
                    <div class="d-flex flex-column">
                        <strong>{{ Auth::user()->first_name }}</strong>
                        <span class="badge bg-secondary text-capitalize"
                            style="width: fit-content; font-size: 0.65rem;">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ url('change/password') }}"><i
                                class="fa-solid fa-gear me-2"></i>Change Password</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('profile') }}"><i
                                class="fa-solid fa-user me-2"></i>Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-grow-1 p-4 m-5">
            <div class="card shadow">
                <div class="card-body">
                    @yield('main')
                </div>
            </div>
        </div>

    </div>


    {{-- Bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>


</body>

</html>
