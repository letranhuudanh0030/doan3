@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block ">{{ $title_page }}</h5>
                            <div class="float-right">
                                  <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm text-uppercase font-weight-bold">Danh sách</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Tên sản phẩm <span class="text-danger">(*)</span>:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                <span class="text-primary">Nhập tên sản phẩm.</span>
                            </div>
                            <div class="form-group">
                                <label for="">Mã code <span class="text-danger"></span>:</label>
                                <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                                <span class="text-primary">Nhập mã code sản phẩm (nếu có).</span>
                            </div>
                            <div class="form-group">
                                <label for="">Đơn giá <span class="text-danger"></span>:</label>
                                <input type="number" class="form-control price" name="price" value="{{ old('price', 0) }}">
                                <span class="text-primary">Nhập đơn giá sản phẩm. Nếu không nhập mặc định là 0 (liên hệ)</span>
                                <input type="text" class="form-control format-price" value="{{ old('price', 0) }}" readonly>
                                <span class="text-primary">Định dạng đơn giá (VNĐ)</span>
                            </div>
                            <div class="form-group">
                                <label for="">Giảm giá <span class="text-danger"></span>:</label>
                                <input type="number" class="form-control" name="discount" value="{{ old('discount', 0) }}">
                                <span class="text-primary">Nhập giá giảm sản phẩm. Nếu < 100 (giảm theo phần trăm), > 100 (lấy giá giảm gốc)</span>
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục <span class="text-danger">(*)</span>:</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="0">--Chọn--</option>
                                    {{ showCategories($categories) }}
                                </select>
                                <span class="text-primary">Chọn danh mục sản phẩm.</span>
                            </div>

                            <div class="form-group">
                                <label for="">Nhà cung cấp <span class="text-danger"></span>:</label>
                                <select name="provider_id" id="" class="form-control">
                                    <option value="0">--Chọn--</option>
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-primary">Chọn nhà cung cấp sản phẩm.</span>
                            </div>
    
                            <div class="form-group">
                                <label class="form-control-label">Hình ảnh: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="image" name="image" readonly value="{{ old('image') }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary browser-image" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='image'>Chọn</button>
                                    </div>
                                </div>
                                <span class="text-primary">Chọn hình của sản phẩm.</span>
                                <br>
                                <img src="{{ old('image') }}" alt="" class="img-fluid product-img" width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Thêm nhiều hình ảnh: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="images" name="images" readonly>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary browser-images" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='images'>Chọn</button>
                                    </div>
                                </div>
                                <span class="text-primary">Thêm nhiều hình của sản phẩm.</span>
                                <br class="">
                                <div class="product-imgs">

                                </div>
                                {{-- <img src="" alt="" class="img-fluid product-imgs" width="150px" height="150px"> --}}
                            </div>

                            <div class="form-group">
                                <label for="">Mô tả ngắn: </label>
                                <textarea name="short_desc" id="short-desc" cols="30" rows="5" class="form-control">{{ old('short-desc', 'Đang cập nhật') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả: </label>
                                <textarea name="desc" id="desc" cols="30" rows="5" class="form-control">{{ old('desc', 'Đang cập nhật') }}</textarea>
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
<script src="{{ asset('tinymce/tinymce.js') }}"></script>
<script src="{{ asset('tinymce/config.js') }}"></script>
<script>
    $(function () {

        $('.price').keyup(function(){
            
            $('.format-price').val(addCommas($(this).val()));
        })

        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2 + ' VNĐ';
        }



        // click categort_image open filemanager
        $('.browser-image').click(function(){
            var input_id = $('.browser-image').attr('data-name-type');
            $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
        })

        $('.browser-images').click(function(){
            var input_id = $('.browser-images').attr('data-name-type');
            $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
        })



        // show image
        $('#modal-file').on('hidden.bs.modal', function (e) {
            var url_img = $('#image').val();
            $('.product-img').attr('src', url_img)

            var url_imgs = $('#images').val();
            var imgs = jQuery.parseJSON(url_imgs)
            var html = ''
            imgs.forEach(element => {
                console.log(element)
                html += '<img src="'+element+'" alt="" class="img-fluid mr-1" width="100px" height="100px">'
            });

            $('.product-imgs').html(html)
          
        });

    });
</script>
@endsection