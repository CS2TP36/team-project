<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="stylesheet" href="pico/css/pico.min.css">
        <title>@yield("title")</title>
    </head>
    <body>
        @include("reusables.admin.header")
        <main class="container">
            @yield("content")
        </main>
        @include("reusables.admin.footer")
    </body>
</html>
