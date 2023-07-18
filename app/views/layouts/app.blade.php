<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{--
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet"/>
--}}
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="gradient-custom">
    <header class="header">
        @include('layouts/_header')
    </header>
    <main class="container">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
{{--
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.5/b-2.4.1/datatables.min.js"></script>
--}}
    <script>
        const isLogged = {{ $isLogged ? 'true' : 'false' }};
    </script>
    <script src="/js/app.js"></script>
</body>
</html>
{{--

<body>
    <main class="layout">
        <header class="header">
            @include('layouts/_header')
        </header>
        @yield('content')
        <footer class="footer">
            @include('layouts/_footer')
        </footer>
    </main>
    @yield('inline-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>--}}