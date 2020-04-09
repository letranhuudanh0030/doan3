<section class="product mb-4">
    <div class="row">
        <div class="col-11 mx-auto">
            <div class="nb-categories mt-4" id="nav-tab" role="tablist">
                <a href="{{ route('shop', ['slug' => $category->slug, 'id' => $category->id]) }}" class="nb-category-title"><span class="">{{ $key }}</span>{{ $category->name }}</a>
                @foreach ($PcategoriesAll->where('parent_id', $category->id) as $subCate)
                    <a href="{{ route('shop', ['slug' => $subCate->slug, 'id' => $subCate->id]) }}" class="nb-category d-none d-lg-inline-block"><i class=""></i>{{ $subCate->name }}</a>
                @endforeach
            </div>
            <div class="row">
                @if ($key % 2 != 0)
                    <div class="col-3 mt-4 d-none d-xl-block">
                        <a href="{{ route('shop', ['slug' => $category->slug, 'id' => $category->id]) }}">
                            <img src="{{ asset($category->image) }}" alt="" class="img-fluid" width="100%">
                        </a>
                    </div>
                @endif
                <div class="col-12 col-lg-12 col-xl-9">
                    <div class="row">
                        @foreach ($product_all as $product)
                            @if ($category->id == $product->category->parent_id)
                                <div class="col-6 col-md-3 mt-4">
                                    <div class="nb-product-border text-center">
                                        <div class="nb-product-title">
                                            <a href="{{ route('single', ['slug' => $product->slug, 'id' => $product->id]) }}" class="nb-p-title" title="{{ $product->name }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="nb-product-content">
                                            <a href="{{ route('single', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                                <div class="nb-box-image">
                                                    <img src="{{ asset($product->image) }}" alt="" class="nb-image img-fluid" style="max-width: 120px;">
                                                    <button class="btn nb-product-btn btn-sm">Liên hệ</button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="nb-product-price">
                                            <span class="nb-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                            @endif                           
                        @endforeach
                    </div>
                </div>
                @if ($key % 2 == 0)
                    <div class="col-3 mt-4 d-none d-xl-block">
                        <a href="{{ route('shop', ['slug' => $category->slug, 'id' => $category->id]) }}">
                            <img src="{{ asset($category->image) }}" alt="" class="img-fluid" width="100%">
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

    