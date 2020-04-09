<section id="hd-article">
    <div class="row">
        <div class="col-11 mx-auto">
            <div class="nb-categories mt-4">
                <a href="" class="nb-category-title"><span class=""><i class="fas fa-newspaper"></i></span>Tin tức</a>
            </div>
            <div class="hd-article-slider mt-4">
                @foreach ($articles as $article)
                    
                    <div class="hd-article-item text-left">
                        <div class="hd-img-box">
                            <a href="{{ route('single.new', ['slug' => $article->slug, 'id' => $article->id]) }}">
                                <img src="{{ asset($article->image) }}" alt="" class="img-fluid mx-auto" style="width: 100%">
                            </a>
                        </div>
                        <div class="hd-title">
                            <a href="{{ route('single.new', ['slug' => $article->slug, 'id' => $article->id]) }}"><h3 title="{{ $article->name }}">{{ $article->name }}</h3></a>
                            <div class="hd-intro">{!! $article->short_desc !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
