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
            <a href="{{ route('article_category.index') }}" class="btn btn-primary text-uppercase font-weight-bold">Danh sách</a>
            <a href="{{ route('article_category.create') }}" class="btn btn-success text-uppercase font-weight-bold">Thêm mới</a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('article_category.search') }}" method="POST">
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
            @foreach ($categories as $key => $category)                
              <tr class="text-center row-{{ $key }}">
                <td class="align-middle">{{ $category->id }}</td>
                <td class="text-left align-middle">{{ $category->name }}</td>
                <td class="align-middle">{{ $category->parent_id == 0 ? 'Loại cha' : $category->where('id', $category->parent_id)->first()->name }}</td>
                <td>
                  <img src="{{ asset($category->image) }}" alt="{{ $category->slug }}" width="50px" height="50px">
                </td>
                <td class="align-middle">
                  <input type="text" value="{{ $category->sort_order }}" class="input-sort sort-order-{{ $key }}" data-name="sort_order" data-id="{{ $category->id }}" data-url="{{ route('article_category.updateStatus') }}">
                </td>
                <td class="align-middle">
                  <a href="void:javascript(0)" class="publish">{!! $category->publish == 1 ? '<i class="fas fa-check text-success fa-lg publish-'.$key.'" data-value="1" data-id="'.$category->id.'" data-url="'.route('article_category.updateStatus').'" data-name="publish"></i>' : '<i class="fas fa-times text-danger fa-lg publish-'.$key.'" data-value="0" data-id="'.$category->id.'" data-url="'.route('article_category.updateStatus').'" data-name="publish"></i>' !!}</a>
                </td>
                <td class="align-middle">
                  <a href="void:javascript(0)" class="highlight">{!! $category->highlight == 1 ? '<i class="fas fa-check text-success fa-lg highlight-'.$key.'" data-value="1" data-id="'.$category->id.'" data-url="'.route('article_category.updateStatus').'" data-name="highlight"></i>' : '<i class="fas fa-times text-danger fa-lg highlight-'.$key.'" data-value="0" data-id="'.$category->id.'" data-url="'.route('article_category.updateStatus').'" data-name="highlight"></i>' !!}</a>
                </td>
                <td class="align-middle">
                  <a href="void:javascript(0)" title="Xóa" class="mr-2 remove-{{ $key }}" data-url="{{ route('article_category.remove') }}" data-id="{{ $category->id }}"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
                  <a href="{{ route('article_category.edit', $category->id) }}" title="Cập nhật"><i class="fas fa-edit fa-lg text-warning"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="float-right">
            {{ $categories->links() }}
        </div>
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