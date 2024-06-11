<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- App CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

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

    {{-- App Js --}}
    <script src="{{ mix('js/app.js') }}"></script>

    {{-- Jexcel Spreadsheet --}}
    <script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
    <script src="https://jsuites.net/docs/v4/jsuites.js"></script>

    {{-- DataTable --}}
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{-- Custom Js --}}
    @stack('scripts')
</body>

</html>
