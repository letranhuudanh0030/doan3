@extends('layouts.layout')
@section('content')
    <div class="row hd-title-page--bg" style="background-image: url({{ asset('uploads/shop_background.jpg') }})">
        <div class="hd-title-page--overlay">
        </div>
        <div class="col-12 hd-title-page">
            {{ $product->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-11 mx-auto">
            <div class="row mt-4">
                <div class="col-12 col-lg-4">
                    <div class="hd-image-show-slider">
                        @if ($product->images)
                            @foreach (explode(',', $product->images) as $image) 
                                <div class="hd-image-show">
                                    <img src="{{ asset($image) }}" alt="" class="img-fluid mx-auto" title="{{ $product->name }}">    
                                </div>
                            @endforeach
                        @else
                            <div class="hd-image-show">
                                <img src="{{ asset($product->image) }}" alt="" class="img-fluid mx-auto" title="{{ $product->name }}">    
                            </div>
                        @endif
                    </div>
                    <div class="hd-image-slider">
                        @if ($product->images)
                            @foreach (explode(',', $product->images) as $image)
                                <div class="hd-image">
                                    <img src="{{ asset($image) }}" alt="" class="img-fluid" title="{{ $product->name }}">
                                </div>
                            @endforeach
                        @else
                            <div class="hd-image">
                                <img src="{{ asset($product->image) }}" alt="" class="img-fluid" title="{{ $product->name }}">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="hd-product-content">
                        <h3 class="hd-product-content__title">
                            {{ $product->name }}
                        </h3>
                        <p class="hd-product-content__price">Giá: <span class="text-danger">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span></p>
                        <!-- AddToAny BEGIN -->
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_google_gmail"></a>
                            <a class="a2a_button_telegram"></a>
                            <a class="a2a_button_facebook_messenger"></a>
                            <a class="a2a_button_skype"></a>
                        </div>
                        
                            <!-- AddToAny END -->
                        <div class="hd-product-content__short-desc mt-4">
                            {!! $product->short_desc !!}
                        </div>
                        <div class="hd-product-content__cta mt-4">
                            <form action="{{ route('add.cart') }}" method="POST">
                                @csrf
                                <div class="quantity">
                                    <button class="minus-btn" type="button" name="button">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                    <input type="text" name="qty" value="1" readonly>
                                    <button class="plus-btn" type="button" name="button">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button class="btn btn-primary btn-lg text-uppercase" type="submit">Đặt hàng</button>
                            </form>
                        </div>
                        <hr>
                        <p class="font-weight-bold hd-product-content__hotline">Hotline: <span class="text-danger">{{ $info->phone }}</span></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="nb-content mt-4">
                        <button class="tablink" onclick="openPage('content', this, '#0f5fb1')" id="defaultOpen">Mô tả</button>
                        <button class="tablink" onclick="openPage('comment', this, '#0f5fb1')">Bình luận</button>
    
                        <div id="content" class="tabcontent">
                            {!! $product->desc !!}
                        </div>
    
                        <div id="comment" class="tabcontent">
                            <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="100%" data-numposts="5"></div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-12">
                    <div class="hd-product-relate">
                        <div class="nb-categories mt-4">
                            <a href="" class="nb-category-title"><span class=""><i class="fas fa-link"></i></span>Sản phẩm cùng loại</a>
                        </div>
                        <div class="hd-product-relate__slider mt-4">
                            @foreach ($product->category->product as $product)
                                <div class="hd-product-relate__item">
                                    <div class="nb-product-border text-center">
                                        <div class="nb-product-title" title="{{ $product->name }}">
                                            <a href="{{ route('single', ['slug' => $product->slug, 'id' => $product->id]) }}" class="nb-p-title">{{ $product->name }}</a>
                                        </div>
                                        <div class="nb-product-content">
                                            <a href="{{ route('single', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                                <div class="nb-box-image">
                                                    <img src="{{ asset($product->image) }}" alt="" class="nb-image img-fluid mx-auto" style="height:200px">
                                                    <button class="btn nb-product-btn">Liên hệ</button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="nb-product-price">
                                            <span class="nb-price">{{ number_format($product->price, 0 , ',', '.') }} VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/single.css') }}">
@endsection
@section('js')
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0"></script>
    <script>
        $(function(){
            $('.hd-image-show-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.hd-image-slider'
            });
            $('.hd-image-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: false,
                
                asNavFor: '.hd-image-show-slider',
                // dots: true,
                // centerMode: true,
                focusOnSelect: true
            });

            $('.hd-product-relate__slider').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                arrows: false,
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

            $('.minus-btn').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');
                var value = parseInt($input.val());

                if (value > 1) {
                    value = value - 1;
                } else {
                    value = 0;
                }

                $input.val(value);

            });

            $('.plus-btn').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');
                var value = parseInt($input.val());

                if (value < 100) {
                    value = value + 1;
                } else {
                    value =100;
                }

                $input.val(value);
            });

                        
        })
        function openPage(pageName, elmnt, color) {
        // Hide all elements with class="tabcontent" by default */
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove the background color of all tablinks/buttons
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }

        // Show the specific tab content
        document.getElementById(pageName).style.display = "block";

        // Add the specific color to the button used to open the tab content
        elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
@endsection