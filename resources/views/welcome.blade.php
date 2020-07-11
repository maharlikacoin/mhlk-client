<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="author" content="MHLK Foundation">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="For The Benefit and Future of Humanity">
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
