<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <style>
        /* Font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: 'Inter', sans-serif !important;
        }

        .no-bullet {
            list-style-type: none;
        }
    </style>
</head>

<body>
    @include('partials.header')
    @include('partials.navbar')

    <main class="container my-5">
        @yield('main')
    </main>

    {{-- jquery --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    {{-- Bootstrap Js --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
