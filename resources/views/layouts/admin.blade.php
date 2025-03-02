<!doctype html>
<html id="admin-page" lang="en" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="stylesheet" href="{{ asset('pico/css/pico.min.css') }}">
        <script src="{{ asset('js/admin/theme.js') }}"></script>
        @if(@session('message'))
            <script>
                alert("{{ session('message') }}");
            </script>
        @endif
        <title>@yield("title")</title>
    </head>
    <body class="d-flex flex-column min-vh-100">
        @include("reusables.admin.header")
        <main class="container flex-grow-1">
            @yield("content")
        </main>
        @include("reusables.admin.footer")
    </body>
</html>
