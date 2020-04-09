@extends('layouts.layout')
@section('content')
    
    <div class="row">
        <div class="col-12 col-lg-11 mx-auto">
           <div class="row">
               <div class="col-12">
                   <div class="nb-border">

                       <div class="row">

                           <div class="col-12 col-lg-6 align-self-center mt-4">

                                {!! $info->map !!}

                           </div>
                           <div class="col-12 col-lg-6 mt-4">
                               <div class="nb-border-contact">
                                   <h3 class="nb-contact-title">Thông tin liên hệ</h3>
                                   <span class="nb-contact-subtitle">Quý khách có thể liên hệ với chúng tôi bằng cách điền thông tin vào mẫu trên. Chúng tôi sẽ liên hệ với quý khách trong thời gian sớm nhất hoặc gọi điện thoại để được tư vấn.</span>
                                   <form action="{{ route('send_contact') }}" class="mt-4" method="POST">
                                        @csrf
                                       <div class="form-group">
                                           <label for="">Họ và tên:</label>
                                           <input type="text" class="form-control" name="fullname" placeholder="Vui lòng nhập tên của bạn">
                                            @error('fullname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                       </div>
                                       <div class="form-group">
                                           <label for="">Điện thoại:</label>
                                           <input type="text" class="form-control" name="phone" placeholder="Vui lòng nhập số điện thoại của bạn">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                       </div>
                                       <div class="form-group">
                                           <label for="">Email:</label>
                                           <input type="text" class="form-control" name="email" placeholder="Vui lòng nhập email của bạn">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                       </div>
                                       <div class="form-group">
                                           <label for="">Nội dung:</label>
                                           <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="Vui lòng nhập số nội dung"></textarea>
                                       </div>
                                       <div class="text-center">
                                           <button type="submit" class="btn btn-primary btn-lg">Gửi thông tin</button>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection
