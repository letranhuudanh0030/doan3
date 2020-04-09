@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-12 col-lg-10 mx-auto">

        <div class="header clearfix text-center my-4">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Value</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mã đơn hàng:</td>
                    <td>{{ request()->vnp_TxnRef }}</td>
                </tr>
                <tr>
                    <td>Số tiền:</td>
                    <td>{{ request()->vnp_Amount / 100 }}</td>
                </tr>
                <tr>
                    <td>Nội dung thanh toán:</td>
                    <td>{{ request()->vnp_OrderInfo }}</td>
                </tr>
                <tr>
                    <td>Mã phản hồi (vnp_ResponseCode):</td>
                    <td>{{ request()->vnp_ResponseCode }}</td>
                </tr>
                <tr>
                    <td>Mã GD Tại VNPAY:</td>
                    <td>{{ request()->vnp_TransactionNo }}</td>
                </tr>
                <tr>
                    <td>Mã Ngân hàng:</td>
                    <td>{{ request()->vnp_BankCode }}</td>
                </tr>
                <tr>
                    <td>Thời gian thanh toán:</td>
                    <td>{{ request()->vnp_PayDate }}</td>
                </tr>
                <tr>
                   
                    <td>Kết quả:</td>
                    <td> @php
                            if ($secureHash == $vnp_SecureHash) {
                                if ($_GET['vnp_ResponseCode'] == '00') {
                                    echo "GD Thanh cong";
                                } else {
                                    echo "GD Khong thanh cong";
                                }
                            } else {
                                echo "Chu ky khong hop le";
                            }
                        @endphp</td>                        
                </tr>


            </tbody>
        </table>
    </div>
</div>
@endsection