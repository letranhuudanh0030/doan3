@extends('layouts.layout')
@section('content')
    <div class="row hd-title-page--bg" style="background-image: url({{ asset('uploads/shop_background.jpg') }})">
        <div class="hd-title-page--overlay">    
        </div>
        <div class="col-12 hd-title-page">
            {{ $article->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-11 mx-auto mt-4">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="hd-article-lastest">
                        <div class="hd-article-title">
                            <h3>Bài viết mới nhất</h3>
                        </div>
                        <div class="hd-article-content">
                            <div class="row">
                                {{-- {{ dd($article->category->article->sortByDesc('created_at')->count()) }} --}}
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($article->category->article->sortByDesc('created_at') as $article_lastest)
                                    @if ($i < 4)
                                        <div class="col-4 mb-2">
                                            <a href="">
                                                <img src="{{ asset($article_lastest->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="col-8 mb-2">
                                            <div class="hd-article-content">
                                                <div class="hd-article-content-title">
                                                    <h4><a href="">{{ $article_lastest->name }}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="hd-container">
                        <div class="hd-container-title">
                            <div class="row">
                                <div class="col-12 col-xl-8">

                                    <h3>{{ $article->name }}</h3>
                                </div>
                                <div class="col-12 col-xl-4">

                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="    display: inline-block;
                                    float: right;">
                                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_google_gmail"></a>
                                        <a class="a2a_button_telegram"></a>
                                        <a class="a2a_button_facebook_messenger"></a>
                                        <a class="a2a_button_skype"></a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="hd-container-desc">
                            {!! $article->content !!}
                        </div>

                        <div class="hd-container-relate">
                            <hr>
                            <h4>Bài viết liên quan: </h4>
                            <ul>
                                @foreach ($article->category->article as $article_rela)
                                    <li>
                                        <a href="{{ route('single.new', ['slug' => $article_rela->slug, 'id' => $article_rela->id]) }}">{{ $article_rela->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                        </div>
                        
                        <div id="comment" class="tabcontent">
                            <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="100%" data-numposts="5"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/new_single.css') }}">
@endsection
@section('js')
<script async src="https://static.addtoany.com/menu/page.js"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0"></script>
@endsection