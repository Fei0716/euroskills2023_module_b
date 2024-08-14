<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Api Billing Management</title>
    <link rel="stylesheet" href="{{asset('storage/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('storage/style.css')}}">
</head>
<body>
    @include('layout.nav')
{{--    main content here--}}
    <main class="container mt-5">
        @yield('content')
    </main>
    <script src="{{asset('storage/bootstrap/bootstrap.min.js')}}"></script>
</body>
</html>
