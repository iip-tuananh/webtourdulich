<meta charset="UTF-8"/>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="#"/>

<script>(function (html) {
        html.className = html.className.replace(/\bno-js\b/, 'js')
    })(document.documentElement);</script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<!-- This site is optimized with the Yoast SEO plugin v21.7 - https://yoast.com/wordpress/plugins/seo/ -->
<title>@yield('title')</title>
<meta name="description" content="">
<meta name="keywords" content="@yield('title')" />
<meta name="robots" content="noodp,index,follow" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="description" content="@yield('description')" />
<link rel="canonical" href="{{ url()->current() }}" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="article" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="{{ url()->current() }}" />
<meta property="og:updated_time" content="2021-08-28T22:06:30+07:00" />
<meta property="og:image" content="@yield('image')" />
<meta property="og:image:secure_url" content="@yield('image')" />
<meta property="og:image:width" content="598" />
<meta property="og:image:height" content="333" />
<meta property="og:image:alt" content="" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="@yield('title')" />
<meta name="twitter:description" content="@yield('description')" />
<meta name="twitter:image" content="@yield('image')" />
<!-- Fav Icon -->
<link rel="icon" href="{{$config->favicon->path ?? ''}}" type="image/x-icon">
<!-- / Yoast SEO plugin. -->
<link href="{{ env('AWS_R2_URL') }}/site/css/bootstrap.min.css" rel="stylesheet"/>
<link href="{{ env('AWS_R2_URL') }}/site/css/font-awesome.min.css" rel="stylesheet"/>
<link href="{{ env('AWS_R2_URL') }}/site/css/style_chung_min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script type="text/javascript" src="{{ env('AWS_R2_URL') }}/site/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="{{ env('AWS_R2_URL') }}/site/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ env('AWS_R2_URL') }}/site/js/js_common.min.js"></script>
