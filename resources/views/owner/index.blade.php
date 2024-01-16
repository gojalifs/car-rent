<!DOCTYPE html>
<html lang="en">
@include('owner.includes.header')

<body>
    <div id="app">

        @include('owner.includes.sidebar')

        @yield('content')


    </div>

    
    @yield('script')
    @include('owner.includes.script')

</body>

</html>
