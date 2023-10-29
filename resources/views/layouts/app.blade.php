<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- Additional styles can be included by child views -->
    @stack('styles')
</head>

<body>
    <div id="app">

        <!-- Main navbar, can include links, dropdowns etc. -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </nav>

        <main class="container mt-4">
            <!-- Main content of the page -->
            @yield('content')
        </main>

    </div>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->

    <!-- Stripe's JavaScript library -->
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Additional scripts can be included by child views -->
    @stack('scripts')
</body>

</
