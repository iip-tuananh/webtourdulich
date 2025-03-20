<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    @include('site.partials.head')
    @yield('css')
</head>

<body ng-app="App" ng-cloak id="homepage">

    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58XLH58"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=126821687974504";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    @include('site.partials.header')
    @yield('content')
    @include('site.partials.footer')
    @include('site.partials.angular_mix')

    @stack('scripts')
</body>

</html>
