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
'data' => isset($data) ? $data : false,
'breadcrumbs' => isset($breadcrumbs) ? $breadcrumbs : [],
'create' => isset($create) ? $create : false,
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
</body>
</html>