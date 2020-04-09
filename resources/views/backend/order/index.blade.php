@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block ">{{ $title_page }}</h5>
      {{-- <div class="float-right">
        <a href="" class="btn btn-primary text-uppercase font-weight-bold">Danh sách</a>
        <button class="btn btn-danger text-uppercase font-weight-bold cta-delete-more" data-ids="" data-url="{{ route('product.remove') }}">Xóa nhiều</button>
        <a href="" class="btn btn-success text-uppercase font-weight-bold">Thêm mới</a>
      </div> --}}
        <div class="form-inline float-right">
            <a href="{{ route('check.order', ['status' => 0, 'publish' => 1 ]) }}" class="btn btn-secondary mr-2">Chờ xác nhận</a>
            <a href="{{ route('check.order', ['status' => 1, 'publish' => 1 ]) }}" class="btn btn-info mr-2">Chưa thanh toán</a>
            <a href="{{ route('check.order', ['status' => 2, 'publish' => 1 ]) }}" class="btn btn-success mr-2">Đã thanh toán</a>
            <a href="{{ route('check.order', ['status' => 3, 'publish' => 1 ]) }}" class="btn btn-primary mr-2">Đã giao hàng</a>
            <a href="{{ route('check.order', ['status' => 4, 'publish' => 0 ]) }}" class="btn btn-danger mr-2">Đã hủy</a>
            <input type="number" class="form-control mr-2 hd-keyword" data-url="{{ route('order.search') }}" placeholder="Nhập mã đơn hàng">
        </div>
    </div>
    <div class="card-body">
        
      <div class="table-responsive">
        <table class="table table-bordered table-hover ">
          <thead>
            <tr class="text-center table-info">
              <th scope="col">ID</th>
              <th scope="col">Họ tên</th>
              <th scope="col">Điện thoại</th>
              <th scope="col">Tổng tiền</th>
              <th scope="col">Phương thức</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Ngày tạo</th>
              <th scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody class="hd-list-order">
            @foreach ($orders as $key => $order)
                <tr class="text-center">
                    <td>{{ $order->id }}</td>
                    <td class="text-left">{{ $order->name }}</td>
                    <td class="text-left">{{ $order->phone }}</td>
                    <td class="text-left">{{ number_format($order->amount, 0, ',', '.') }}</td>
                    <td>{{ $order->payment }}</td>
                    <td class="order-status-{{ $order->id }}">
                        @if ($order->status == 1 && $order->publish == 1)
                            <span class="text-info">Chưa thanh toán</span>
                        @elseif($order->status == 2 && $order->publish == 1)
                            <span class="text-success">Đã thanh toán</span>
                        @elseif($order->status == 0 && $order->publish == 1)
                            <span class="text-secondary">Chưa xác nhận</span>
                        @elseif($order->status == 3 && $order->publish == 1)
                            <span class="text-primary">Đã giao hàng</span>
                        @elseif($order->publish == 0) 
                            <span class="text-danger">Đã hủy đơn hàng</span>
                        @endif    
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="void:javascript(0)" title="Xác nhận đơn hàng" class="hd-confirm hd-confirm-{{ $order->id }} {{ $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->publish == 0 ? 'isDisabled' : '' }}" data-id="{{ $order->id }}" data-url="{{ route('post.order') }}" data-status="{{ $order->status }}"><i class="fas fa-clipboard-check fa-lg text-info mr-1"></i></a>
                        <a href="void:javascript(0)" title="Xác nhận thanh toán" class="hd-success hd-success-{{ $order->id }} {{ $order->status == 2 || $order->status == 3 || $order->publish == 0 ? 'isDisabled' : '' }}" data-id="{{ $order->id }}" data-url="{{ route('post.order') }}" data-status="{{ $order->status }}"><i class="fas fa-check-circle text-success fa-lg mr-1"></i></a>
                        <a href="void:javascript(0)" title="Xác nhận giao hàng" class="hd-ship hd-ship-{{ $order->id }} {{ $order->status == 3 || $order->publish == 0 ? 'isDisabled' : '' }}" data-id="{{ $order->id }}" data-url="{{ route('post.order') }}" data-status="{{ $order->status }}"><i class="fas fa-shipping-fast text-primary fa-lg mr-1"></i></a>
                        <a href="void:javascript(0)" title="Xác nhận hủy đơn hàng" class="hd-remove hd-remove-{{ $order->id }} {{ $order->publish == 0 || $order->status == 3 ? 'isDisabled' : '' }}" data-id="{{ $order->id }}" data-url="{{ route('post.order') }}" data-status="{{ $order->status }}" data-publish="{{ $order->publish }}"><i class="fas fa-times-circle text-danger fa-lg mr-1"></i></a>
                        <a href="void:javascript(0)" title="Xem chi tiết" class="hd-detail" data-id="{{ $order->id }}" data-url="{{ route('post.order') }}"><i class="fas fa-info-circle fa-lg mr-1"></i></a>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <div class="float-right">
            {{ $orders->links() }}
        </div>
      </div>
    </div>
  </div>
  @include('layouts.partials.admin.modal_order')
@endsection
@section('js')
    <script>
        
        $(function(){
            actionconfirm()
            actionSuccess()
            actionShip()
            actionDetail()
            actionRemove()
            
            function formatNumber (num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,").replace('.00', '') + ' VNĐ'
            }
            function actionconfirm() {
                $('.hd-confirm').click(function(){
                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    var status = $(this).attr('data-status')
                    if(status == 1 || status == 2 || status == 3) {
                        $('.hd-confirm-'+id).off("click")
                    } else {

                        axios.post(url, {
                            confirm_id: id
                        })
                        .then(function(response){
                            console.log(response)
                            if(response.data == 1){
                                $('body').find('.order-status-'+id).html('<span class="text-info">Chưa thanh toán</span>')
                                $('.hd-confirm-'+id).addClass("isDisabled")
                                $('.hd-confirm-'+id).off("click")
                                toastr.warning('Kích hoạt trạng thái xác nhận đơn hàng.')
                            }
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                    }
                })
            }
            function actionSuccess() {
                $('.hd-success').click(function(){
                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    var status = $(this).attr('data-status')
                    if(status == 2 || status == 3) {
                        $('.hd-confirm-'+id).off("click")
                        $('.hd-success-'+id).off("click")
                        $('.hd-remove-'+id).off("click")
                    } else {
                        axios.post(url, {
                            success_id: id
                        })
                        .then(function(response){
                            console.log(response)
                            if(response.data == 2){
                                $('.order-status-'+id).html('<span class="text-success">Đã thanh toán</span>')
                                $('.hd-confirm-'+id).addClass("isDisabled")
                                $('.hd-success-'+id).addClass("isDisabled")
                                $('.hd-remove-'+id).addClass("isDisabled")
                                $('.hd-confirm-'+id).off("click")
                                $('.hd-success-'+id).off("click")
                                $('.hd-remove-'+id).off("click")
                                toastr.success('Kích hoạt trạng thái đã thanh toán.')
                            }
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                    }
                })
            }
            function actionShip() {
                $('.hd-ship').click(function(){
                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    var status = $(this).attr('data-status')
                    if(status == 3) {
                        $('.hd-confirm-'+id).off("click")
                        $('.hd-success-'+id).off("click")
                        $('.hd-remove-'+id).off("click")
                        $('.hd-ship-'+id).off("click")
                    } else {
                        axios.post(url, {
                            ship_id: id
                        })
                        .then(function(response){
                            console.log(response)
                            if(response.data == 3){
                                $('.order-status-'+id).html('<span class="text-primary">Đã giao hàng</span>')
                                $('.hd-confirm-'+id).addClass("isDisabled")
                                $('.hd-success-'+id).addClass("isDisabled")
                                $('.hd-remove-'+id).addClass("isDisabled")
                                $('.hd-ship-'+id).addClass("isDisabled")
                                $('.hd-confirm-'+id).off("click")
                                $('.hd-success-'+id).off("click")
                                $('.hd-remove-'+id).off("click")
                                $('.hd-ship-'+id).off("click")
                                toastr.success('Kích hoạt trạng thái đã giao hàng.')
                            }
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                    }
                })
            }
            function actionRemove() {
                $('.hd-remove').click(function(){
                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    var status = $(this).attr('data-status')
                    var publish = $(this).attr('data-publish')
                    if(status == 2 || publish == 0) {
                        $('.hd-confirm-'+id).off("click")
                        $('.hd-success-'+id).off("click")
                        $('.hd-remove-'+id).off("click")
                    } else {
                        axios.post(url, {
                            remove_id: id
                        })
                        .then(function(response){
                            console.log(response)
                            if(response.data == 0){
                                $('.order-status-'+id).html('<span class="text-danger">Đã hủy đơn hàng</span>')
                                $('.hd-confirm-'+id).addClass("isDisabled")
                                $('.hd-success-'+id).addClass("isDisabled")
                                $('.hd-remove-'+id).addClass("isDisabled")
                                $('.hd-confirm-'+id).off("click")
                                $('.hd-success-'+id).off("click")
                                $('.hd-remove-'+id).off("click")
                                toastr.danger('Đã hủy đơn hàng.')
                            }
                        })
                        .catch(function(error){
                            console.log(error)
                        })
                    }
                })
            }
            function actionDetail() {
                $('.hd-detail').click(function(){
                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    axios.post(url, {
                        id: id
                    })
                    .then(function(response){
                        console.log(response.data[1])
                        $('.hd-name span').html(response.data[0].name)
                        $('.hd-phone span').html(response.data[0].phone)
                        $('.hd-email span').html(response.data[0].email)
                        $('.hd-address span').html(response.data[0].address)
                        $('.hd-payment span').html(response.data[0].payment)
                        $('.hd-payment-info span').html(response.data[0].payment_info)
                        $('.hd-amount').text(formatNumber(response.data[0].amount))
                        let status;
                        if(response.data[0].status == 2 && response.data[0].publish == 1) {
                            status = 'Đã thanh toán'
                        } else if(response.data[0].status == 1 && response.data[0].publish == 1){
                            status = 'Chưa thanh toán'
                        } else if(response.data[0].status == 0 && response.data[0].publish == 1){
                            status = 'Chưa xác nhận'
                        } else if(response.data[0].status == 3 && response.data[0].publish == 1){
                            status = 'Đã giao hàng'
                        } else {
                            status = 'Đã hủy đơn hàng'
                        }
                        $('.hd-status span').html(status)
                        $('.hd-message span').html(response.data[0].message)
                        let trOpen = '<tr>';
                        let tdOpen = '<td class="align-middle">';
                        let tdClose = '</td>';
                        let trClose = '</tr>';
                        let data = '';
                        let price;
                        response.data[1].forEach(element => {
                            data += trOpen
                            data += tdOpen + element.id + tdClose
                            data += tdOpen + '<img src='+element.image+' width="50px" height="50px">' + tdClose
                            data += tdOpen + element.name + tdClose

                            if(element.discount > 100){
                                price = element.price - element.discount 
                            } else {
                                price = element.price - (element.price * element.discount / 100)
                            }

                            data += tdOpen + formatNumber(price) + tdClose
                            data += tdOpen + element.pivot.qty + tdClose
                            data += tdOpen + formatNumber(element.pivot.qty * element.price) + tdClose
                            data += trClose
                            $('.hd-data').html(data);
                        });

                        
                    })
                    .catch(function(error){
                        console.log(error)
                    })
                    $('#modal-detail').modal();
                })
            }


            $('.hd-keyword').keyup(function(){
                var keyword = $(this).val()
                var url = $(this).attr('data-url')
                axios.post(url, {
                    keyword: keyword
                })
                .then(function(response){
                    console.log(response.data.data)
                    var result = ''
                    var trOpen = '<tr class="text-center">'
                    var tdOpen = '<td>'
                    var tdLeftOpen = '<td class="text-left">'
                    var tdCenterOpen = '<td class="text-center">'
                    var tdRightOpen = '<td class="text-right">'
                    var tdClose = '</td>'
                    var trClose = '</tr>'
                    var disabledClass1
                    var disabledClass2
                    var disabledClass3
                    response.data.data.forEach(element => {
                        result += trOpen
                        result += tdOpen + element.id + tdClose
                        result += tdLeftOpen + element.name + tdClose
                        result += tdLeftOpen + element.phone + tdClose
                        result += tdLeftOpen + element.amount + tdClose
                        result += tdOpen + element.payment + tdClose
                        if(element.status == 2 && element.publish == 1 ) {
                            status = '<span class="text-success">Đã thanh toán</span>'
                        } else if(element.status == 1 && element.publish == 1){
                            status = '<span class="text-info">Chưa thanh toán</span>'
                        } else if(element.status == 0 && element.publish == 1){
                            status = '<span class="text-secondary">Chưa xác nhận</span>'
                        }else if(element.status == 3 && element.publish == 1){
                            status = '<span class="text-primary">Đã giao hàng</span>'
                        } else if(element.publish == 0){
                            status = '<span class="text-danger">Đã hủy đơn hàng</span>'
                        }
                        result += '<td class="order-status-'+element.id+'">' + status + tdClose
                        result += tdOpen + element.created_at + tdClose
                        result += tdOpen

                        disabledClass1 = element.status == 1 || element.status == 2 || element.publish == 0 ? "isDisabled" : ""
                        disabledClass2 = element.status == 2 || element.status == 3 || element.publish == 0 ? "isDisabled" : ""
                        disabledClass3 = element.publish == 0 || element.status == 3 ? "isDisabled" : ""
                        disabledClass4 = element.status == 3 || element.publish == 0 ? "isDisabled" : ""

                        result += '<a href="void:javascript(0)" title="Xác nhận giao hàng" class="hd-confirm hd-confirm-'+element.id+' '+disabledClass1+'" data-id="'+element.id+'" data-url="{{ route('post.order') }}" data-status="'+element.status+'"><i class="fas fa-confirmping-fast fa-lg text-info mr-1"></i></a>'

                        result += '<a href="void:javascript(0)" title="Xác nhận thanh toán" class="hd-success hd-success-'+element.id+' '+disabledClass2+'" data-id="'+element.id+'" data-url="{{ route('post.order') }}" data-status="'+element.status+'"><i class="fas fa-check-circle text-success fa-lg mr-1"></i></a>'

                        result += '<a href="void:javascript(0)" title="Xác nhận giao hàng" class="hd-ship hd-ship-'+element.id+' '+disabledClass4+'" data-id="'+element.id+'" data-url="{{ route('post.order') }}" data-status="'+element.status+'"><i class="fas fa-shipping-fast text-primary fa-lg mr-1"></i></a>'

                        result += '<a href="void:javascript(0)" title="Xác nhận hủy đơn hàng" class="hd-remove hd-remove-'+element.id+' '+disabledClass3+'" data-id="'+element.id+'" data-url="{{ route('post.order') }}" data-status="'+element.publish+'"><i class="fas fa-times-circle text-danger fa-lg mr-1"></i></a>'

                        result += '<a href="void:javascript(0)" title="Xem chi tiết" class="hd-detail" data-id="'+element.id+'" data-url="{{ route('post.order') }}"><i class="fas fa-info-circle fa-lg mr-1"></i></a>'

                        result += tdClose
                        result += trClose

                    });
                    $('.hd-list-order').html(result)
                    actionconfirm()
                    actionSuccess()
                    actionShip()
                    actionDetail()
                    actionRemove()
                })
                
            })
        })
    </script>
@endsection

@section('css')
    <style>
        .isDisabled {
            color: currentColor;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
        }
    </style>
@endsection
