<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Văn phòng phẩm sài gòn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
    table {
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
        background-color: #70bbd9;
        color: white;
    }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                    <tr>
                        <td>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                <tr>
                                    <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
                                        <label style="font-size: 50px;color:white;">VPPSaiGon</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                        <div><b style="text-transform: uppercase"> Thông tin khách hàng</b></div>
                                        <hr>
                                        <div>
                                            <div style="width: 50%;float: left;"><b>Thông tin thanh toán</b>
                                                <p>Họ và tên: {{ $info['name'] }}</p>
                                                <p>Email: {{ $info['email'] }}</p>
                                                <p>Điện thoại: {{ $info['phone'] }}</p>
                                                <p>@if ($info['payment'] == 'online')
                                                    Thanh toán: Online
                                                @else
                                                    Thanh toán: Offline
                                                @endif</p>
                                            </div>
                                            <div style="width: 50%;float: left;"><b>Địa chỉ giao hàng</b>
                                                <p>Địa chỉ: {{ $info['address'] }}</p>
                                                <p>Ghi chú: {{ $info['message'] }}</p>
                                            </div>
                                        </div>

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Mã</th>
                                                    <th>Sản phẩm</th>
                                                    <th>Đơn giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody style="background:#f5f5f5">
                                                @foreach (Cart::session(config('variables.sessionKey'))->getContent() as $item)
                                                    <tr>
                                                        <td style="text-align:center;">{{ $item->id }}</td>
                                                        <td style=>{{ $item->name }}</td>
                                                        <td style="text-align: right;">{{ number_format($item->price, null,',', '.') }} VNĐ</td>
                                                        <td style="text-align: center;">{{ $item->quantity }}</td>
                                                        <td style="text-align: right;">{{ number_format($item->getPriceSum(), null, ',', '.') }} VNĐ</td>
                                                    </tr>
                                                @endforeach
                                    <td colspan="4" style="text-align: right;"><b>Tổng giá trị đơn hàng:</b></td>
                                    <td style="text-align: right;color:red"><b>{{ number_format(Cart::getTotal(), null, ',', '.') }} VNĐ</b></td>
                                <tr>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>
