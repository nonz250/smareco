<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield('head')
<body>
<div id="pre-loader" class="d-flex align-items-center justify-content-center overlay">
    <div class="spinner-grow text-secondary" role="status" style="width: 3rem; height: 3rem;">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<style>
    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        z-index: 9999;
        background: rgba(255, 255, 255, .8);
    }
</style>
<div id="app">
    @yield('content')
</div>
</body>
@yield('script')
</html>
