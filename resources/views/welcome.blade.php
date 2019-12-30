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
    <title>Maharlika Coin (MHLK) - For Humanity, Especially the Filipino People</title>
    <!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script data-ad-client="ca-pub-1747538166059459" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body class="nk-body body-wider bg-light mode-onepage">
<div id="app">
    <welcome-index :is-logged-in="!!'{{ session('authAddress') }}'"></welcome-index>
</div>
<!-- JavaScript -->
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
