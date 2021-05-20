<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="facebook-domain-verification" content="ab6qiwz8pksrs3armgq8v0wysiy78v" />
        <title>{{ config('app.name') }} - @yield('title')</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/lightbox.css">
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js'); 
            fbq('init', '3636249593265828'); 
            fbq('track', 'PageView');
        </script>
        <noscript> 
            <img height="1" width="1" src="https://www.facebook.com/tr?id=3636249593265828&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    </head>
    <body>
        @include('layouts.navbar')
        @include('layouts.banners')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </body>
    @section('scripts')
        <script src="/js/app.js" defer></script>
        <script src="/js/mdb.min.js" defer></script>
        <script src="/js/lightbox.js" defer></script>
    @show
</html>
