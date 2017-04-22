<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('layouts.links')
</head>
<body>
@include('header', [
'main' => isset($main) ? $main : false,
'activeRubric' => isset($activeRubric) ? $activeRubric : [],
'activeQuestion' => isset($activeQuestion) ? $activeQuestion : []
])
<main>
    <div class="container">
        <div class="row">
            <div class="col l4">
                @yield('sidebar')
            </div>
            <div class="col l8">
                @yield('content')
            </div>
        </div>
    </div>
</main>
@include('footer', ['version' => '1.0.0'])
<script src="libs/jquery/dist/jquery.min.js" defer></script>
<script src="libs/materialize/dist/js/materialize.min.js" defer></script>
<script src="js/app.js" defer></script>
</body>
</html>