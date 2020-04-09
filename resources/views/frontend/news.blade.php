@extends('layouts.layout')
@section('content')
    <div class="row hd-title-page--bg" style="background-image: url({{ asset('uploads/shop_background.jpg') }})">
        <div class="hd-title-page--overlay">    
        </div>
        <div class="col-12 hd-title-page">
            Tin tức
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-11 mx-auto mt-4">
            <div class="row">
                @foreach ($articles as $article)
                    
                    <div class="col-3 hd-new-item mb-4">
                        <div class="hd-new-item__border">
                            <div class="hd-new-item__border--box-img">
                                <a href="{{ route('single.new', ['slug' => $article->slug, 'id' => $article->id]) }}">
                                    <img src="{{ $article->image }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="hd-new-item__border--content">
                                <h4 class="hd-title" title="{{ $article->name }}"><a href="{{ route('single.new', ['slug' => $article->slug, 'id' => $article->id]) }}">{{ $article->name }}</a></h4>
                                <div class="hd-short-desc">
                                    {!! $article->short_desc !!}
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('single.new', ['slug' => $article->slug, 'id' => $article->id]) }}" class="text-danger">Xem thêm...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="float-right">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endsection