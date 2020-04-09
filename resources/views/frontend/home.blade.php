@extends('layouts.layout')
@section('content')
    @include('frontend.components.slide')

    @foreach ($Pcategories as $cateRoot)        
        @foreach ($PcategoriesAll->where('parent_id', $cateRoot->id)->where('highlight', 1)->sortByDesc('sort_order') as $key => $category)
            @include('frontend.components.product')
        @endforeach
    @endforeach

    @include('frontend.components.article')
    
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slide.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/article.css') }}">
    
@endsection
@section('js')
    <script>
        $(function(){
            $('.banner-slide').slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                arrows: true,
                autoplay: true,
                autoplaySpeed: 2000,
                prevArrow: $('.nb-next-pre'),
                nextArrow: $('.nb-next-next'),
                infinite: true,

            });

            $('.hd-article-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                arrows:false,
                dots:false,
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
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
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });

            
        })
    </script>
@endsection