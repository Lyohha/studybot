<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('header')

    <div id="app">
        @yield('content')
    </div>

    @include('footer')
</html>