<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{config('company.MAIN_INFO_SOCIETE_NOM')}} | @yield("title")</title>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="keywords" content=""/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon"
          href="{{route("dolibarr",['mycompany/logos/' . config("company.MAIN_INFO_SOCIETE_LOGO_SQUARRED")])}}"
          type="image/png">

    @yield("robots")

    <meta name="description"
          content="@yield("description", "")"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:type" content="@yield("type", "website")"/>
    <meta property="og:title" content="{{config('company.MAIN_INFO_SOCIETE_NOM')}} | @yield("title")"/>
    <meta property="og:description"
          content="@yield("description", "")"/>
    <meta property="og:image"
          content="@yield("image", route("dolibarr",['mycompany/logos/' . config("company.MAIN_INFO_SOCIETE_LOGO_SQUARRED")]))"/>
    <!-- Stylesheets -->
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('/css/plugins.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/confetti.css')}}">

    @stack("styles")

</head>

<body>
<!-- Main Header-->
@include("partials.header")
<!--End Main Header -->

@yield("content")

@include("partials.footer")

@stack('modals')
<div class="conf-wrapper d-none">
    @for($i=149;$i>=0;$i--)
        <div class="confetti-{{$i}}"></div>
    @endfor
</div>
<!-- Plugins JS -->
<script src="{{asset('/js/plugins.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('/js/main.js')}}"></script>

@stack('scripts')
<script loading="lazy">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = 'b51a2d3458351b942d4c98d628cd7498f2cab201';
    _smartsupp.cookieDomain = '.ideal-info.net';
    _smartsupp.sitePlatform = 'Boutique en ligne: Ideal Informatique';
    window.smartsupp || (function (d) {
        var s, c, o = smartsupp = function () {
            o._.push(arguments)
        };
        o._ = [];
        s = d.getElementsByTagName('script')[0];
        c = d.createElement('script');
        c.type = 'text/javascript';
        c.charset = 'utf-8';
        c.async = true;
        c.src = '//www.smartsuppchat.com/loader.js?';
        s.parentNode.insertBefore(c, s);
    })(document);

    $(document).ready(function () {
        if (!localStorage.getItem("birthday2022")) {
            $(".conf-wrapper").removeClass("d-none");
            setTimeout(function () {
                $(".conf-wrapper").remove();
                localStorage.setItem("birthday2022", 'true');
            }, 5000);
        }
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script defer src="https://www.googletagmanager.com/gtag/js?id=UA-15277545-1"></script>
<script defer>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-15277545-1');
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script defer type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62437b6036661322"></script>
</body>
</html>
