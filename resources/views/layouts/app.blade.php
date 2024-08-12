<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    @stack('styles')
    @stack('scripts')

</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
