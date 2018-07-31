<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("css/app.css")}}">

    <title>@yield('page_title', config('app.name'))</title>
</head>
<body>
    <section class="container-fluid bg-teal ">
        <div class="container p-3 text-white">
            <h1 class="title ">@yield('page_title')</h1>
        </div>
    </section>
    <div class="container">
        @yield('main')
    </div>
</body>
</html>
