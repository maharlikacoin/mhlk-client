<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Formula Green Foundation">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="For humanity, especially the Filipino people">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- Site Title  -->
    <title>@yield('title') - Maharlika Coin (MHLK)</title>
    <!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

</head>

<body class="nk-body body-wider bg-light">
<div class="nk-wrap" id="app">
    @include('single-pages.header')

    @yield('content')

    @include('layouts.footer')

</div>
<div class="preloader"><span class="spinner spinner-round"></span></div>

<!-- JavaScript -->
<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
