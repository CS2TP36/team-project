<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title can be rewritten by extending pages -->
    <title>@yield('title')</title>
    <link href=" {{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
<!-- utilises a consistent header -->
@include("reusables.header")
<main>
    <!-- allows each page to add its own main content by overriding the content section. -->
    @yield('content')
</main>
<!-- utilises a consistent footer -->
@include("reusables.footer")
</body>
</html>
