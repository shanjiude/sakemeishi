<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no">
    @hasSection('title')
        <title>@yield('title') | お酒の名刺</title>
    @else
        <title>お酒の名刺</title>
    @endif
    <link rel="icon" type="image/png" href="{{ asset('cheers.png') }}">
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')
</body>
</html>
