<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Front style -->
    <link id="callCss" rel="stylesheet" href="/assets/front/css/front.min.css" media="screen"/>
    <link href="/assets/front/css/base.css" rel="stylesheet" media="screen"/>
    <!-- Front style responsive -->
    <link href="/assets/front/css/front-responsive.min.css" rel="stylesheet"/>
    <link href="/assets/front/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="/assets/front/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="/assets/front/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/front/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/front/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/front/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/front/images/ico/apple-touch-icon-57-precomposed.png">
    <style type="text/css" id="enject"></style>
</head>
<body>
@include('front.include.header')

@include('front.banners.home_page_banner')

<div id="mainBody">
    <div class="container">
        <div class="row">
            @include('front.include.sidebar')
            @yield('content');
        </div>
    </div>
</div>
<!-- Footer ================================================================== -->
@include('front.include.footer')
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="/assets/front/js/jquery.js" type="text/javascript"></script>
<script src="/assets/front/js/front.min.js" type="text/javascript"></script>
<script src="/assets/front/js/google-code-prettify/prettify.js"></script>

<script src="/assets/front/js/front.js"></script>
<script src="/assets/front/js/jquery.lightbox-0.5.js"></script>

</body>
</html>
