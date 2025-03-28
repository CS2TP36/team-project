<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/favicon.ico') }}" rel="icon">
    <!-- title can be rewritten by extending pages -->
    <title>@yield('title')</title>
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/style.css') }}" rel="stylesheet">
    <!-- A place where scripts can be imported -->
    <script src="@yield('script')"></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>
    <!-- <script src="{{ asset('js/theme.js') }}"></script> -->
    <script src="{{ asset('js/darkmode.js') }}" defer></script>
</head>
<body>
<!-- utilises a consistent header -->
@include("reusables.header")
<main>
    <!-- allows each page to add its own main content by overriding the content section. -->
    @yield('content')
</main>
<!-- if you dont want a footer on a page, set noFooter to true in php near top -->
@if (!isset($noFooter))
    <!-- utilises a consistent footer -->
    @include("reusables.footer")
@endif
</body>
</html>
