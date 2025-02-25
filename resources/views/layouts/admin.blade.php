<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="stylesheet" href="{{ asset('pico/css/pico.min.css') }}">
        <title>@yield("title")</title>
    </head>
    <body class="d-flex flex-column min-vh-100">
    @include("reusables.admin.header")
        <main class="container flex-grow-1">
        @yield("content")
    </main>

    <footer class="mt-auto">
        @include("reusables.admin.footer")
    </footer>
    </body>
</html>
