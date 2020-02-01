<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Formula Green Foundation">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="For humanity, especially the Filipino people">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- Site Title  -->
    <title>Maharlika Coin (MHLK) - For Humanity, especially the Filipino people</title>
    <!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body style="background-color: #e9ecef;">
<div id="app">
    <wallet-index address="{{ session('authAddress') }}"></wallet-index>
</div>
<!-- JavaScript -->
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
