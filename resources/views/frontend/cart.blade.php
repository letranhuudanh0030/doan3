@extends('layouts.layout')
@section('content')
    <section id="nb-cart">
        <div class="row">
            <div class="col-10 mx-auto">
                <h3 class="nb-title-cart">
                    Giỏ hàng của bạn
                    <a href="{{ route('clear.cart') }}" class="float-right btn btn-danger pl-4 pr-4">Xóa hết</a>
                </h3>
                <div class="nb-content">
                    <table class="table table-hover">
                        <thead>
                          <tr class="table-primary text-center">
                            <th scope="col">STT</th>
                            <th scope="col">Hình sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Giảm giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Xóa</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($cartCollection as $key => $item)

                                <tr class="text-center nb-row-{{ $key }}" data-id="{{ $key }}">
                                    <td class="align-middle">{{ $key}}</td>
                                    <td><img src="{{ asset($item->attributes->image) }}" alt="" class="img-fluid" width="50px" height="50px"></td>
                                    <td class="text-left align-middle">{{ $item->name }}</td>
                                    <td class="text-danger align-middle">{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                    <td class="align-middle">
                                        @if ($item->attributes->discount <= 100)
                                            {{ number_format($item->attributes->discount, null, ',', '') }} %
                                        @else
                                            {{ number_format($item->attributes->discount, null, ',', '.') }} VNĐ
                                        @endif    
                                    </td>
                                    <td class="align-middle">
                                        <div class="quantity">
                                            <button class="minus-btn" type="button" name="button" data-url="{{ route('update.cart') }}" data-id="{{ $item->id }}">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input type="text" name="qty" value="{{ $item->quantity }}" readonly class="input-{{ $key }}">
                                            <button class="plus-btn" type="button" name="button" data-url="{{ route('update.cart') }}" data-id="{{ $item->id }}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-danger align-middle nb-total-{{ $key }}" id="{{ $key }}">{{ number_format($item->getPriceSum(), 0, ',', '.') }} VNĐ</td>
                                    <td class="align-middle">
                                        <a href="void:javascript(0)" title="Xóa"><i class="fa fa-trash text-danger nb-cta-action nb-remove" data-url="{{ route('remove.cart') }}" data-id="{{ $item->id }}"></i></a>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div>

                        <p class="text-uppercase text-danger text-right font-weight-bold nb-cta-action nb-title-amount">Tổng tiền: <span class="ml-3 nb-amount">{{ number_format(Cart::getTotal(), null, ',', '.') }} VNĐ</span></p>

                    </div>
                </div>
                <hr>
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="btn btn-success">Quay lại mua hàng</a>
                    <a href="{{ route('checkout') }}" class="btn btn-danger">Thanh toán đơn hàng</a>
                </div>
            </div>
        </div>
    </section>
  
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('js')
<script>
        $(function(){
            $('.minus-btn').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');
                var value = parseInt($input.val());
                var id = $this.attr('data-id')
                var url = $this.attr('data-url')

                if (value > 1) {
                    value = value - 1;
                } else {
                    value = 0;
                }

                $input.val(value);

                axios.post(url, {
                    id: id,
                    value: value
                })
                .then(function(response){
                    var cartArr = response.data
                    if($('.nb-total-' + cartArr.id).attr('id') == cartArr.id){

                        $('.nb-total-' + cartArr.id).text(cartArr.total)
                        $('.nb-amount').text(cartArr.amount)
                    }
                })
                .catch(function(error){
                    console.log(error)
                })

            });

            $('.plus-btn').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');
                var value = parseInt($input.val());
                var id = $this.attr('data-id')
                var url = $this.attr('data-url')

                if (value < 100) {
                    value = value + 1;
                } else {
                    value =100;
                }

                $input.val(value);

                axios.post(url, {
                    id: id,
                    value: value
                })
                .then(function(response){
                    var cartArr = response.data
                    if($('.nb-total-' + cartArr.id).attr('id') == cartArr.id){

                        $('.nb-total-' + cartArr.id).text(cartArr.total)
                        $('.nb-amount').text(cartArr.amount)
                    }
                })
                .catch(function(error){
                    console.log(error)
                })
            });

            $('.nb-remove').on('click', function(e) {
                var url = $(this).attr('data-url')
                var id = $(this).attr('data-id')
                axios.post(url, {
                    id: id
                })
                .then(function(response){
                    $('.nb-row-' + response.data.id).fadeOut()
                    $('.nb-amount').text(response.data.amount)
                    console.log(response.data)
                })
                .catch(function(error){
                    console.log(error)
                })
            });
        })
    </script>
@endsection

