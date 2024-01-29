<!-- Main file for all pages. -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PVML</title>
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
    @yield('head')
</head>

<body>
    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ mix('resources/assets/logo.png') }}" alt="Bootstrap" width="30" height="30" />
                <h4 class="my-0 logo-text">PVML</h4>
            </a>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ \Illuminate\Support\Facades\Auth::getUser()['name'] }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/dashboard">Área Reservada</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="/logout" onclick="event.preventDefault();
                                                this.closest('form').submit();">Sair</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Entrar</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
