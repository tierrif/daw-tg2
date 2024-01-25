<!-- Main file for all pages. -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
</head>

<body>
    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">PVML</a>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading1">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    @if ($page === 'home')
        <x-home />
    @elseif ($page === 'login')
        <x-login />
    @elseif ($page === 'frequentuser')
        <x-frequent-user />
    @else
        <x-not-found />
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
