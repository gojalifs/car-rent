<!DOCTYPE html>
<html lang="en">
@include('includes.header')

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('includes.navbar')

            @include('includes.sidebar')

            @yield('content')

            @include('includes.footer')

        </div>
    </div>

    @yield('script')
    @include('includes.script')
</body>

</html>
