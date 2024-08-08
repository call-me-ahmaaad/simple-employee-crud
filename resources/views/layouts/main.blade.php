<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMPLE EMPLOYEE CRUD</title>
    <link rel="shortcut icon" href="{{ URL::asset('/img/employee-favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ URL::asset('/css/main_layout.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('head')
</head>

<body>
    <div class="wrapper">
        @yield('container')
    </div>
</body>

</html>
