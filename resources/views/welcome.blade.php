<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="For The Benefit and Future of Humanity">
    <meta charset="utf-8">
    <meta name="author" content="Maharlika Coin">
    <meta name="description"
          content="The Maharlika Coin (MHLK) was created to distribute the value of its intellectual property, natural resources, and selected physical assets directly for the benefit of humanity.">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="maharlikacoin">
    <meta name="twitter:title" content="Maharlika Coin - For The Benefit and Future of Humanity">
    <meta name="twitter:description"
          content="The Maharlika Coin (MHLK) was created to distribute the value of its intellectual property, natural resources, and selected physical assets directly for the benefit of humanity.">
    <meta name="twitter:creator" content="maharlikacoin">
    <meta name="twitter:image:src"
          content="https://res.cloudinary.com/stardust389/image/upload/c_scale,w_512/v1594532034/Maharlika%20Coin/maharlikacoin-logo-dark_dlfopu.png">
    <meta name="twitter:domain" content="maharlikacoin.com">
    <meta property="og:url" content="https://www.maharlikacoin.com">
    <meta property="og:title" content="Maharlika Coin">
    <meta property="og:description"
          content="The Maharlika Coin (MHLK) was created to distribute the value of its intellectual property, natural resources, and selected physical assets directly for the benefit of humanity.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://res.cloudinary.com/stardust389/image/upload/c_scale,w_512/v1594532034/Maharlika%20Coin/maharlikacoin-logo-dark_dlfopu.png">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- Site Title  -->
    <title>Maharlika Coin (MHLK) - For The Benefit and Future of Humanity</title>
    <!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body class="nk-body body-wider bg-light mode-onepage">
<div id="app">
    <welcome-index :is-logged-in="!!'{{ session('authAddress') }}'"></welcome-index>
</div>
<!-- JavaScript -->
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
