<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; z-index: 99999 !important;}
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    .autocomplete-suggestion { 
        cursor: pointer;
    }
</style>
<div id="hd-header-top">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-11 mx-auto">
                <div class="row">
                    
                    <div class="col-4 hd-intro-header text-left d-none d-lg-block">
                        {{-- {{ $info->meta_title }} --}}bind data
                    </div>
                    <div class="col-12 col-md-4 hd-phone-header text-center mx-auto">
                        {{-- Hotline: {{ $info->phone }} --}}bind data
                    </div>
                    <div class="col-4 hd-address-header text-right d-none d-lg-block">
                        {{-- Địa chỉ: {{ $info->address }} --}}bind data
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="hd-header-content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-11 mx-auto">
                <div class="row">
                    <div class="col-12 col-lg-4 text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset($info->logo) }}" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-lg-6 text-center align-self-center hd-search">
                        <form action="{{ route('search') }}" method="POST" id="header-search">
                            <div class="form-inline d-none d-lg-block">
                                @csrf
                                {{-- <select name="" id="" class="form-control hd-category">
                                    <option value="">Tất cả</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select> --}}
                                <input type="text" class="form-control hd-keyword" width="100%" placeholder="Tìm kiếm..." name="search" id="autocomplete">
                                <button class="btn btn-primary hd-cta-search" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                        <div id="search-suggest" class="s-suggest" style="color:white"></div>
                    </div>
                    <div class="col-2 text-left align-self-center d-none d-lg-block hd-cart">
                        <button class="btn btn-primary hd-cart-button"><i class="fas fa-shopping-cart"></i><span class="num-cart">{{ Cart::session(config('variables.sessionKey'))->getContent()->count() }}</span></button>
                        <ul class="nb-list-cart">
                            @foreach (Cart::session(config('variables.sessionKey'))->getContent() as $item)
                                <li class="nb-item-cart">
                                    <img src="{{ $item->attributes->image }}" alt="{{ $item->name }}" width="50px" height="50px">
                                    <span class="ml-2">{{ $item->name }}</span><i class="ml-2 text-danger font-weight-bold">X {{ $item->quantity }}</i>
                                </li>
                                <hr>
                            @endforeach
                            <li class="text-center font-weight-bold text-uppercase text-danger">
                                Tổng: {{ number_format(Cart::getTotal(), null, ',', '.') }} VNĐ
                            </li>
                            <hr>
                            <li class="text-center nb-cta-cart">
                                <a href="{{ route('cart') }}">Kiểm tra giỏ hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#autocomplete').autocomplete({
            serviceUrl: '{{ route('searchAuto') }}',
            paramName: 'query',
            transformResult: function(response) {
                console.log(JSON.parse(response)['data']);
                return {
                    suggestions: $.map(JSON.parse(response)['data'], function(dataItem) {
                        return { value: dataItem.name, data: dataItem.slug};
                    })
                };
            }
        });
    })
</script>