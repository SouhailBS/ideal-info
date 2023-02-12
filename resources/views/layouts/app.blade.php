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
    {{--<style>{{file_get_contents(public_path('/css/plugins.css'))}}</style>--}}
<!-- Main Style CSS -->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"
          href="{{asset('/css/style.css')}}?version=1.2.3">
    <noscript>
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    </noscript>
    <!--link rel="stylesheet" href="{{asset('/css/confetti.css')}}"-->

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
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div id="notification" style="z-index: 9999;" class="toast-container position-fixed top-0 end-0 p-3"></div>
</div>
<!-- Plugins JS -->
<script src="{{asset('/js/plugins.js')}}"></script>
<!-- Main JS -->
<script defer src="{{asset('/js/main.js')}}?version=1.1"></script>
<!--script defer>$(document).ready(function () {
        if (!localStorage.getItem("birthday2022")) {
            $(".conf-wrapper").removeClass("d-none");
            setTimeout(function () {
                $(".conf-wrapper").remove();
                localStorage.setItem("birthday2022", 'true');
            }, 5000);
        }
        //element =
    });</script-->
@stack('scripts')
<!-- Messenger Plugin de discussion Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin de discussion code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "258371030847188");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v14.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/fr_FR/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

</body>
</html>
