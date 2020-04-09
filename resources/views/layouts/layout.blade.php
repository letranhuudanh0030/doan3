<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('uploads/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('uploads/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('uploads/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('uploads/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('uploads/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('uploads/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('uploads/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('uploads/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('uploads/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('uploads/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon/favicon-16x16.png') }}">
    {{-- <link rel="manifest" href="{{ asset('uploads/favicon/manifest.json') }}"> --}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('uploads/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.autocomplete.js') }}"></script>
    {{-- <link href="{{ asset('source_admin/css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}
    @include('layouts.partials.frontend.css')
    @yield('css')
</head>
<body>
    @include('layouts.partials.frontend.header')
    @include('layouts.partials.frontend.menu')
    <div class="container-fluid">
        @yield('content')
    </div>
    @include('frontend.components.provider')
    @include('layouts.partials.frontend.footer')
    @include('layouts.partials.frontend.js')
   
    @yield('js')
    <script>
        $(function(){
            $('.hd-provider-slider').slick({
                slidesToShow: 6,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows:false,
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,

                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    }
                ]
            })
        })
    </script>
</body>
</html>