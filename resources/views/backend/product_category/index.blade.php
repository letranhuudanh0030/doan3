@extends('layouts.main')
@section('css')
    {{-- <link href="{{ asset('source_admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    <style>
      .input-sort{
        border: 1px solid #DCDADA;
        padding: 2px 5px;
        width: 33px;
        text-align: center;
        background: #FFF;
        color: red;
        font-weight: bold;
      }
    </style>
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block ">{{ $title_page }}</h5>
      <div class="float-right">
            <a href="{{ route('product_category.index') }}" class="btn btn-primary text-uppercase font-weight-bold">Danh sách</a>
            <a href="{{ route('product_category.create') }}" class="btn btn-success text-uppercase font-weight-bold">Thêm mới</a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('product_category.search') }}" method="POST">
        @csrf
        <div class="mb-4 form-inline">
          <input type="text" class="form-control mr-2 hd-keyword" name="keyword" placeholder="Nhập mã hoặc tên">
          <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" data-order='[[ 0, "desc" ]]'>
          <thead>
            <tr class="text-center table-info">
              <th>Mã</th>
              <th>Danh mục</th>
              <th>Danh mục cha</th>
              <th>Hình ảnh</th>
              <th>Thứ tự</th>
              <th>Hiển thị</th>
              <th>Nổi bật</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            {{ showTable($categories, route('product_category.updateStatus'), route('product_category.remove')) }}
          </tbody>
        </table>
        {{-- <div class="float-right">
            {{ $categories->links() }}
        </div> --}}
      </div>
    </div>
  </div>
  @include('layouts.partials.admin.modal_delete')
@endsection
@section('js')
    <!-- Page level plugins -->
    {{-- <script src="{{ asset('source_admin/vendor/datatables/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('source_admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('source_admin/js/demo/datatables-demo.js') }}"></script> --}}
    <script src="{{ asset('js/index.js') }}"></script>
   
@endsection