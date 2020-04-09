<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-body text-center">
            @if (Route::currentRouteName() == 'product_category.index')
                Bạn có chắc muốn xóa ?<br> ( tất cả bài viết thuộc danh mục này cũng sẽ bị xóa ).
            @else
                Bạn có chắc muốn xóa ?
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm nb-yes" data-dismiss="modal" data-id="" data-url="" data-key="">Đồng ý</button>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy bỏ</button>
        </div>
    </div>
    </div>
</div>