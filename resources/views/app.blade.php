<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('header')

    <div id="wrapper">
        @yield('content')
    </div>

    @include('footer')
</html>