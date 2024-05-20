<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <style>
        /* Font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: 'Inter', sans-serif !important;
            /* direction: rtl !important; */
        }

        .no-bullet {
            list-style-type: none;
        }
    </style>

    {{-- Select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    {{-- Jexcel Spreadsheet --}}
    <link rel="stylesheet" href="https://jsuites.net/docs/v4/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />

</head>

<body>
    @php
        $isLoginView = $isLoginView ?? false;
    @endphp

    @if ($isLoginView == false)
        @include('partials.header')
        @include('partials.navbar')
    @endif

    <main class="container my-5">
        @yield('main')
    </main>

    {{-- jquery --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    {{-- Bootstrap Js --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Jexcel Spreadsheet --}}
    <script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
    <script src="https://jsuites.net/docs/v4/jsuites.js"></script>
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Custom Js --}}
    @stack('scripts')
</body>

</html>
