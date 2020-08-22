<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield('head')
<body>
<div id="app">
    @yield('content')
</div>
</body>
@yield('script')
</html>
