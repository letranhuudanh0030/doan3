<section id="nb-banner-slide">
    <div class="nb-next-pre"><i class="fa fa-arrow-left"></i></div>
    <div class="banner-slide row">
        @foreach ($slides as $slide)
            <img src="{{ asset($slide->image) }}" alt="{{ $slide->slug }}" class="img-fluid">
        @endforeach
    </div>
    <div class="nb-next-next"><i class="fa fa-arrow-right"></i></div>
</section>
