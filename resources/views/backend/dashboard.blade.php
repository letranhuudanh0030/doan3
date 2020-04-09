@extends('layouts.main')
@section('content')
<div class="p-3 bg-gradient-success text-white"><i class="fas fa-info-circle"></i> Chào mừng đến với hệ thống quản trị.
</div>
<div class="row mt-4">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="{{ route('check.order', ['status' => 0, 'publish' => 1]) }}" class="text-decoration-none">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Đơn hàng chờ xác nhận</div>
                        </a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders->where('status', 0)->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-receipt fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="{{ route('check.order', ['status' => 1, 'publish' => 1 ]) }}" class="text-decoration-none">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đơn hàng chưa thanh toán</div>
                        </a>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $orders->where('status', 1)->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="{{ route('check.order', ['status' => 2,'publish' => 1]) }}" class="text-decoration-none">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn hàng đã thanh toán</div>
                        </a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders->where('status', 2)->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice-dollar fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="{{ route('check.order', ['status' => 4, 'publish' => 0]) }}" class="text-decoration-none">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Đơn hàng đã hủy</div>
                        </a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders->where('publish', 0)->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection