@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('product_category.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block ">{{ $title_page }}</h5>
                            <div class="float-right">
                                  <a href="{{ route('product_category.index') }}" class="btn btn-primary btn-sm text-uppercase font-weight-bold">Danh sách</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Tên danh mục <span class="text-danger">(*)</span>:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                <span class="text-primary">Nhập tên danh mục sản phẩm.</span>
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục <span class="text-danger"></span>:</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="0">--Chọn--</option>
                                    {{ showCategories($categories) }}
                                </select>
                                <span class="text-primary">Chọn danh mục cha. Nếu không chọn mặc định là danh mục cha.</span>
                            </div>
    
                            <div class="form-group">
                                <label class="form-control-label">Hình ảnh: </label>
                                {{-- <div class="col-sm-10 mb-3"> --}}
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="category_image" name="cate_image" readonly value="{{ old('category_image') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary browser" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='category_image'>Chọn</button>
                                        </div>
                                    </div>
                                    <span class="text-primary">Chọn hình của danh mục.</span>
                                    <br>
                                    <img src="{{ old('category_image') }}" alt="" class="img-fluid cate-img" width="150px" height="150px">
                                {{-- </div> --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn  btn-primary text-uppercase" type="submit" name="close" value="1">Lưu và đóng</button>
                            <button class="btn  btn-primary text-uppercase" type="submit" name="back" value="1">Lưu và thêm mới</button>
                            <button class="btn  btn-primary text-uppercase">Reset</button>
                        </div>
                    </div>
                </div>
                <div class="col-4">
    
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block "><i class="fas fa-check-circle"></i> Tùy chọn</h5>
                            </div>
                            <div class="card-body">
                                <label for="" class="custom-control-inline">Hiển thị:</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="publish" name="publish" value="1">
                                    <label class="custom-control-label" for="publish">Có</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="unpublish" name="publish" value="0" checked>
                                    <label class="custom-control-label" for="unpublish">Không</label>
                                </div><br>
                                <label for="" class="custom-control-inline">Nổi bật:</label>
                                <div class="custom-control custom-radio custom-control-inline mt-2">
                                    <input type="radio" class="custom-control-input" id="highlight" name="highlight" value="1">
                                    <label class="custom-control-label" for="highlight">Có</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="unhighlight" name="highlight" value="0" checked>
                                    <label class="custom-control-label" for="unhighlight">Không</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block "><i class="fas fa-ad"></i> Seo</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Meta title: </label>
                                    <input type="text" class="form-control" name="meta_title" placeholder="Nhập tiêu đề dùng trong seo." value="{{ old('meta_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Meta keyword: </label>
                                    <input type="text" class="form-control" name="meta_keyword" placeholder="Nhập từ khóa dùng trong seo." value="{{ old('meta_keyword') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Meta description: </label>
                                    <textarea name="meta_desc" id="" cols="30" rows="4" class="form-control" placeholder="Nhập mô tả dùng trong seo.">{{ old('meta_desc') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('layouts.partials.admin.modal_gallery')
@endsection
@section('js')
<script>
    $(function () {

        // click categort_image open filemanager
        $('.browser').click(function(){
            var input_id = $('.browser').attr('data-name-type');
            $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
        })

        // show image
        $('#modal-file').on('hidden.bs.modal', function (e) {
            var url_cate_img = $('#category_image').val();
            $('.cate-img').attr('src', url_cate_img);
        });
    });
</script>
@endsection