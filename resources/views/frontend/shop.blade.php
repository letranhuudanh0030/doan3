@extends('layouts.layout')
@section('content')
    <div class="row hd-title-page--bg" style="background-image: url({{ asset('uploads/shop_background.jpg') }})">
        <div class="hd-title-page--overlay">
            
        </div>
        <div class="col-12 hd-title-page">
            @if (isset($category))
                {{ $category->name }}
            @else
                Tìm kiếm với từ khóa: <span class="text-danger">{{ request()->search }}</span>
            @endif
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <div class="col-11 mx-auto">
            <div class="row">
                <div class="col-3 text-left hd-category d-none d-lg-block">
                    @foreach ($categories->where('parent_id', $categoryRoot->id) as $cate)   
                        <h4 class="hd-category__title"><a href="{{ route('shop', ['slug' => $cate->slug, 'id' => $cate->id]) }}">{{ $cate->name }}</a></h4>
                        <ul class="hd-category__sub">
                            @foreach ($categories->where('parent_id', $cate->id) as $subCate)                         
                                <li class="hd-category__sub-item">
                                    <a href="{{ route('shop', ['slug' => $subCate->slug, 'id' => $subCate->id]) }}" class="hd-category__sub-item__link">{{ $subCate->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
                <div class="col-12 col-lg-9 hd-product">
                    <div class="row">
                        @foreach ($products as $product)                           
                            <div class="col-6 col-md-3 mb-4">
                                <div class="nb-product-border text-center">
                                    <div class="nb-product-title">
                                        <a href="{{ route('single', ['slug' => $product->slug, 'id' => $product->id]) }}" class="nb-p-title" title="{{ $product->name }}">{{ $product->name }}</a>
                                    </div>
                                    <div class="nb-product-content">
                                        <a href="{{ route('single', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                            <div class="nb-box-image">
                                                <img src="{{ asset($product->image) }}" alt="" class="nb-image img-fluid" style="width: 100%">
                                                <button class="btn nb-product-btn">Liên hệ</button>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="nb-product-price">
                                        <span class="nb-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="float-right">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection