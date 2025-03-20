<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    @include('site.partials.head')
    @yield('css')
</head>

<body ng-app="App" ng-cloak id="homepage">
    @include('site.partials.header')
    @yield('content')
    @include('site.partials.footer')
    @include('site.partials.angular_mix')

    @stack('scripts')
</body>

</html>
