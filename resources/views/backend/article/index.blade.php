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
        <a href="{{ route('article.index') }}" class="btn btn-primary text-uppercase font-weight-bold">Danh sách</a>
        <button class="btn btn-danger text-uppercase font-weight-bold cta-delete-more" data-ids="" data-url="{{ route('article.remove') }}">Xóa nhiều</button>
        <a href="{{ route('article.create') }}" class="btn btn-success text-uppercase font-weight-bold">Thêm mới</a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('article.search') }}" method="POST">
        @csrf
        <div class="mb-4 form-inline">
            <input type="text" class="form-control mr-2 hd-keyword" name="keyword" placeholder="Nhập mã hoặc tên">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-hover ">
          <thead>
            <tr class="text-center table-info">
              <th scope="col">ID</th>
                <th scope="col">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check-all">
                        <label class="custom-control-label" for="check-all"></label>
                    </div>
                </th>
              <th scope="col">Bài viết</th>
              <th scope="col">Danh mục</th>
              <th scope="col">Hình ảnh</th>
              <th scope="col">Thứ tự</th>
              <th scope="col">Hiển thị</th>
              <th scope="col">Nổi bật</th>
              <th scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($articles as $key => $article)                
              <tr class="text-center row-{{ $key }} remove-m{{ $article->id }}">
                  <td class="align-middle">{{ $article->id }}</td>
                  <td class="align-middle">
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="check-{{ $key }}" data-id="{{ $article->id }}">
                          <label class="custom-control-label" for="check-{{ $key }}"></label>
                      </div>
                  </td>
                <td class="text-left align-middle">{{ $article->name }}</td>
                <td class="align-middle">{{ $article->category->name }}</td>
                <td>
                  <img src="{{ asset($article->image) }}" alt="{{ $article->slug }}" width="50px" height="50px">
                </td>
                <td class="align-middle">
                  <input type="text" value="{{ $article->sort_order }}" class="input-sort sort-order-{{ $key }}" data-name="sort_order" data-id="{{ $article->id }}" data-url="{{ route('article.updateStatus') }}">
                </td>
                <td class="align-middle">
                  <a href="void:javascript(0)" class="publish">{!! $article->publish == 1 ? '<i class="fas fa-check text-success fa-lg publish-'.$key.'" data-value="1" data-id="'.$article->id.'" data-url="'.route('article.updateStatus').'" data-name="publish"></i>' : '<i class="fas fa-times text-danger fa-lg publish-'.$key.'" data-value="0" data-id="'.$article->id.'" data-url="'.route('article.updateStatus').'" data-name="publish"></i>' !!}</a>
                </td>
                <td class="align-middle">
                  <a href="void:javascript(0)" class="highlight">{!! $article->highlight == 1 ? '<i class="fas fa-check text-success fa-lg highlight-'.$key.'" data-value="1" data-id="'.$article->id.'" data-url="'.route('article.updateStatus').'" data-name="highlight"></i>' : '<i class="fas fa-times text-danger fa-lg highlight-'.$key.'" data-value="0" data-id="'.$article->id.'" data-url="'.route('article.updateStatus').'" data-name="highlight"></i>' !!}</a>
                </td>
                <td class="align-middle">
                  <a href="void:javascript(0)" title="Xóa" class="mr-2 remove-{{ $key }}" data-url="{{ route('article.remove') }}" data-id="{{ $article->id }}"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
                  <a href="{{ route('article.edit', $article->id) }}" title="Cập nhật"><i class="fas fa-edit fa-lg text-warning"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="float-right">
            {{ $articles->links() }}
        </div>
      </div>
    </div>
  </div>
  @include('layouts.partials.admin.modal_delete')
  @include('layouts.partials.admin.modal_delete_all')
@endsection
@section('js')
    <!-- Page level plugins -->
    {{-- <script src="{{ asset('source_admin/vendor/datatables/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('source_admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('source_admin/js/demo/datatables-demo.js') }}"></script> --}}
    <script src="{{ asset('js/index.js') }}"></script>
@endsection