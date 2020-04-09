@extends('layouts.main')
@section('css')

@endsection
@section('content')
<form action="{{ route('config.post', $website->id) }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block "><i class="fas fa-cog"></i> {{ $title_page }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên website:</label>
                        <input type="text" class="form-control" name="name" value="{{ $website->name }}">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Hình ảnh Logo: </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="image" name="image" readonly value="{{ $website->logo }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary browser-image" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='image'>Chọn</button>
                            </div>
                        </div>
                        <span class="text-primary">Chọn hình làm logo.</span>
                        <br>
                        <img src="{{ asset($website->logo) }}" alt="{{ $website->name }}" class="img-fluid logo-img" width="150px" height="150px">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Hình ảnh favicon: </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="favicon" name="favicon" readonly value="{{ $website->favicon }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary browser-favicon" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='favicon'>Chọn</button>
                            </div>
                        </div>
                        <span class="text-primary">Chọn hình làm favicon.</span>
                        <br>
                        <img src="{{ asset($website->favicon) }}" alt="{{ $website->name }}" class="img-fluid favicon-img" width="150px" height="150px">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Mạng xã hội:</label>
                        <textarea name="social" id="" cols="30" rows="5" class="form-control config">{{ $website->social }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Bản đồ:</label>
                        <textarea name="map" id="" cols="30" rows="5" class="form-control config">{{ $website->map }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Video:</label>
                        <textarea name="video" id="" cols="30" rows="5" class="form-control config">{{ $website->video }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Lưu</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block "><i class="fas fa-info-circle"></i> Thông tin</h5>
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="">Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ $website->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Điện thoại:</label>
                            <input type="text" class="form-control" name="phone" value="{{ $website->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ:</label>
                            <input type="text" class="form-control" name="address" value="{{ $website->address }}">
                        </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary text-uppercase d-inline-block "><i class="fas fa-ad"></i> SEO</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Meta title:</label>
                        <input type="text" class="form-control" name="meta_title" value="{{ $website->meta_title }}">
                    </div>
                    <div class="form-group">
                        <label for="">Meta keyword:</label>
                        <input type="text" class="form-control" name="meta_keyword" value="{{ $website->meta_keyword }}">
                    </div>
                    <div class="form-group">
                        <label for="">Meta description:</label>
                        <textarea name="meta_desc" id="" cols="30" rows="5" class="form-control">{{ $website->meta_desc }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@include('layouts.partials.admin.modal_gallery')
@endsection
@section('js')
<script src="{{ asset('tinymce/tinymce.js') }}"></script>
<script src="{{ asset('tinymce/config.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>

<script>
    // click categort_image open filemanager
    $('.browser-image').click(function(){
        var input_id = $('.browser-image').attr('data-name-type');
        $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
    })
    $('.browser-favicon').click(function(){
        var input_id = $('.browser-favicon').attr('data-name-type');
        $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
    })


    // show image
    $('#modal-file').on('hidden.bs.modal', function (e) {
        var url_img = $('#image').val();
        $('.logo-img').attr('src', url_img)

        var url_favicon_img = $('#favicon').val();
        $('.favicon-img').attr('src', url_favicon_img)

    });
</script>
@endsection