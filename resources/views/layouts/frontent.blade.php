<!DOCTYPE html>
<html lang="en">
@include('include.head')
<body data-instant-intensity="mousedown">
    @include('include.header')
        @yield('content')
    @include('include.footer')
    @include('include.script')
</body>
</html>
