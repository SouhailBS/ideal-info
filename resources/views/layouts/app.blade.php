<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{config('company.MAIN_INFO_SOCIETE_NOM')}} | @yield("title")</title>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="keywords" content=""/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" href="{{route("dolibarr",['mycompany/logos/' . config("company.MAIN_INFO_SOCIETE_LOGO_SQUARRED")])}}" type="image/png">

    @yield("robots")

    <meta name="description"
          content="@yield("description", "")"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:type" content="@yield("type", "website")"/>
    <meta property="og:title" content=" | @yield("title")"/>
    <meta property="og:description"
          content="@yield("description", ""))"/>
    <meta property="og:image" content="@yield("image", route("dolibarr",['mycompany/logos/' . config("company.MAIN_INFO_SOCIETE_LOGO_SQUARRED")]))"/>
    <!-- Stylesheets -->
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('/css/plugins.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

    @stack("styles")
</head>

<body>
<!-- Main Header-->
@include("partials.header")
<!--End Main Header -->

@yield("content")

@include("partials.footer")

<!-- Plugins JS -->
<script src="{{asset('/js/plugins.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('/js/main.js')}}"></script>

@stack('scripts')
</body>
</html>
