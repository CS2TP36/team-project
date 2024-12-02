<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/favicon.ico') }}" rel="icon">
    <!-- title can be rewritten by extending pages -->
    <title>@yield('title')</title>
    <link href=" {{ asset('css/style.css') }}" rel="stylesheet">
    <!-- A place where scripts can be imported -->
    <script src="@yield('script')"></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>
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
