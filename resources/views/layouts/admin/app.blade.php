<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }} - @yield('title')</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body>
        <main>
            @include('layouts.admin.nav')
            <div class="main-container">
                
                @include('layouts.admin.sidenav')
                <div class="container">
                    <div class="row justify-content-center">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        
        @include('layouts.admin.footer')
    </body>
    @section('scripts')
        <script src="/js/app.js" defer></script>
        <script src="/js/mdb.min.js" defer></script>
    @show
</html>
