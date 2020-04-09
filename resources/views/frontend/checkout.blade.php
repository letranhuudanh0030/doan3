@extends('layouts.layout')
@section('content')
    <section id="nb-checkout">
        <form action="{{ route('post.checkout') }}" method="POST">
            <div class="row">
                <div class="col-12  col-lg-10 mx-auto">
                    <h3 class="nb-title-cart">
                        thông tin đơn hàng của bạn
                    </h3>
                    <div class="row mt-4 mb-4">
                        <div class="col-12 col-lg-5 ">
                            <div class="row">
                                <div class="col-12">
                                    <div class="nb-box-cart">
                                        <div class="nb-title-checkout text-center">
                                            <h4 class="text-uppercase font-weight-bold nb-cta-action">Tổng tiền: <span class="ml-3 nb-amount">{{ number_format(Cart::getTotal(), null, ',', '.') }} VNĐ</span></h4>
                                        </div>
                                        <div class="nb-content-checkout">
                                            <ul class="nb-list-cart">
                                                @foreach($cartCollection as $item)
                                                    <li class="nb-item-cart mt-3">
                                                        <img src="{{ asset($item->attributes->image) }}" alt="" width="50px" height="50px" class="d-none d-lg-block col-lg-2 float-left">
                                                        <span class="col-5 col-lg-5 float-left">{{ $item->name }}</span>
                                                        <i class="text-danger font-weight-bold float-left col-2 col-lg-2">X {{ $item->quantity }}</i>
                                                        <span class="text-black font-weight-bold float-left col-5 col-lg-3">{{ number_format($item->getPriceSum(), 0, ',', '.') }} VNĐ</span>
                                                        <br><br>
                                                    </li>
                                                    <hr>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="nb-box-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="nb-offline" name="payment" class="custom-control-input" value="offline" checked>
                                            <label class="custom-control-label" for="nb-offline">Thanh toán trực tiếp khi nhận hàng</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="nb-online" name="payment" class="custom-control-input" value="online">
                                            <label class="custom-control-label" for="nb-online">Thanh toán bằng hình thức chuyển khoản</label>
                                        </div>
                                        <div class="form-group mt-2 hd-bank">
                                            <label for="bank_code">Ngân hàng</label>
                                            <select name="bank_code" id="bank_code" class="form-control">
                                                <option value="">Không chọn</option>
                                                <option value="NCB"> Ngan hang NCB</option>
                                                <option value="AGRIBANK"> Ngan hang Agribank</option>
                                                <option value="SCB"> Ngan hang SCB</option>
                                                <option value="SACOMBANK">Ngan hang SacomBank</option>
                                                <option value="EXIMBANK"> Ngan hang EximBank</option>
                                                <option value="MSBANK"> Ngan hang MSBANK</option>
                                                <option value="NAMABANK"> Ngan hang NamABank</option>
                                                <option value="VNMART"> Vi dien tu VnMart</option>
                                                <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                                <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                                <option value="HDBANK">Ngan hang HDBank</option>
                                                <option value="DONGABANK"> Ngan hang Dong A</option>
                                                <option value="TPBANK"> Ngân hàng TPBank</option>
                                                <option value="OJB"> Ngân hàng OceanBank</option>
                                                <option value="BIDV"> Ngân hàng BIDV</option>
                                                <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                                <option value="VPBANK"> Ngan hang VPBank</option>
                                                <option value="MBBANK"> Ngan hang MBBank</option>
                                                <option value="ACB"> Ngan hang ACB</option>
                                                <option value="OCB"> Ngan hang OCB</option>
                                                <option value="IVB"> Ngan hang IVB</option>
                                                <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="nb-form-checkout">
                                <div class="card">
                                    <div class="card-header text-uppercase font-weight-bold">
                                        Thông tin thanh toán
                                    </div>
                                    <div class="card-body">

                                            @csrf
                                            <div class="form-row">
                                                <div class="col-12 col-lg-2">
                                                    <label for="">Họ và tên <span class="text-danger">(*)</span>: </label>
                                                </div>
                                                <div class="col-12 col-lg-10">
                                                    <input type="text" class="form-control" placeholder="Vui lòng nhập họ và tên" name="fullname">
                                                    @error('fullname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12 col-lg-2">
                                                    <label for="">Email <span class="text-danger">(*)</span>: </label>
                                                </div>
                                                <div class="col-12 col-lg-10">
                                                    <input type="text" class="form-control" placeholder="Vui lòng Email" name="email">
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12 col-lg-2">
                                                    <label for="">Điện thoại <span class="text-danger">(*)</span>: </label>
                                                </div>
                                                <div class="col-12 col-lg-10">
                                                    <input type="text" class="form-control" placeholder="Vui lòng điện thoại" name="phone">
                                                    @error('phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12 col-lg-2">
                                                    <label for="">Địa chỉ: </label>
                                                </div>
                                                <div class="col-12 col-lg-10">
                                                    <input type="text" class="form-control" placeholder="Vui lòng địa chỉ" name="address">
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="col-12 col-lg-2">
                                                    <label for="">Ghi chú: </label>
                                                </div>
                                                <div class="col-12 col-lg-10">
                                                    <textarea name="message" id="" cols="30" rows="6" class="form-control" placeholder="Ghi chú về đơn hàng. Ví dụ ghi chú đặc biệt để giao hàng."></textarea>
                                                </div>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <button class="btn btn-success" type="submit">Hoàn tất đơn hàng</button>
                                                <a href="{{ route('cart') }}" class="btn btn-secondary">Trở lại giỏ hàng</a>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('js')
    <script>
        $(function(){
            $('#nb-online').click(function(){
                $('.hd-bank').css('display', 'block')
            })
            $('#nb-offline').click(function(){
                $('.hd-bank').css('display', 'none')
            })
        })
    </script>
@endsection

