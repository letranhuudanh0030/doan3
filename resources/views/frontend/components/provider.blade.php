<section id="hd-provider">
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mx-auto">
                <div class="nb-categories mt-4">
                    <a href="" class="nb-category-title"><span class=""><i class="fas fa-handshake"></i></span>Đối tác</a>
                </div>
                <div class="hd-provider-slider mt-4">
                    @foreach ($providers as $provider)
                        <div class="hd-provider-item">
                            <img src="{{ asset($provider->image) }}" alt="" class="img-fluid" style="height: 80px">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>