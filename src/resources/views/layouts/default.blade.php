<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield('head')
<body>
<div id="pre-loader" class="position-fixed bg-white" style="width: 100%; height: 100%; top: 0; opacity: 0.8;">
    <div class="d-flex justify-content-center" style="margin-top: 40%;">
        <div class="spinner-grow text-secondary" role="status" style="width: 3rem; height: 3rem;">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<div id="app">
    @yield('content')
</div>
</body>
@yield('script')
</html>
