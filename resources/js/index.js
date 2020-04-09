$(function () {

    // check all
    $("#check-all").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    // update status
    for (let index = 0; index < $('tbody tr').length; index++) {
        if ($('.publish-' + index).length) {

            $('.publish-' + index).click(function () {
                var id = $('.publish-' + index).attr('data-id')
                var value = $('.publish-' + index).attr('data-value')
                var type = $('.publish-' + index).attr('data-name')
                var url = $('.publish-' + index).attr('data-url')

                axios.post(url, {
                        id: id,
                        value: value,
                        type: type
                    })
                    .then(function (response) {
                        console.log(response.data.publish)
                        if (response.data.publish == 1) {
                            $('.publish-' + index).attr('class', 'fas fa-check text-success fa-lg publish-' + index)
                            $('.publish-' + index).attr('data-value', 1)
                            toastr.success('Kích hoạt trạng thái thành công.')
                        } else {
                            $('.publish-' + index).attr('class', 'fas fa-times text-danger fa-lg publish-' + index)
                            $('.publish-' + index).attr('data-value', 0)
                            toastr.warning('Hủy bỏ trạng thái thành công.')
                        }

                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            })
        }
        if ($('.highlight-' + index).length) {
            $('.highlight-' + index).click(function () {
                var id = $('.highlight-' + index).attr('data-id')
                var value = $('.highlight-' + index).attr('data-value')
                var type = $('.highlight-' + index).attr('data-name')
                var url = $('.highlight-' + index).attr('data-url')

                axios.post(url, {
                        id: id,
                        value: value,
                        type: type
                    })
                    .then(function (response) {
                        console.log(response.data.highlight)
                        if (response.data.highlight == 1) {
                            $('.highlight-' + index).attr('class', 'fas fa-check text-success fa-lg highlight-' + index)
                            $('.highlight-' + index).attr('data-value', 1)
                            toastr.success('Kích hoạt trạng thái thành công.')
                        } else {
                            $('.highlight-' + index).attr('class', 'fas fa-times text-danger fa-lg highlight-' + index)
                            $('.highlight-' + index).attr('data-value', 0)
                            toastr.warning('Hủy bỏ trạng thái thành công.')
                        }

                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            })
        }

        if ($('.sort-order-' + index).length) {
            $('.sort-order-' + index).keyup(function () {
                var value = $('.sort-order-' + index).val()
                var url = $('.sort-order-' + index).attr('data-url')
                var id = $('.sort-order-' + index).attr('data-id')
                var type = $('.sort-order-' + index).attr('data-name')
                axios.post(url, {
                        id: id,
                        value: value,
                        type: type
                    })
                    .then(function (response) {
                        console.log(response)
                        toastr.success('Cập nhật thứ tự thành công.')
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            })
        }

        if ($('.row-' + index).length) {
            $('.remove-' + index).click(function () {
                var id = $('.remove-' + index).attr('data-id')
                var url = $('.remove-' + index).attr('data-url')
                $('#modal-delete').modal();
                $('.nb-yes').attr('data-id', id)
                $('.nb-yes').attr('data-url', url)
                $('.nb-yes').attr('data-key', index)
            })
        }
    }

    $('.nb-yes').click(function () {
        var id = $('.nb-yes').attr('data-id')
        var url = $('.nb-yes').attr('data-url')
        var key = $('.nb-yes').attr('data-key')
        if (id) {
            $('.row-' + key).fadeOut("slow");
            axios.post(url, {
                    id: id
                })
                .then(function (response) {
                    console.log(response);
                    toastr.success('Thao tác xóa thành công.');
                })
                .catch(function (error) {
                    console.log(error);
                })
        }

    })
    // remove much
    $("input:checkbox").change(function () {
        var someObj = {};
        someObj.fruitsGranted = [];
        someObj.fruitsDenied = [];

        $("input:checkbox").each(function () {
            if ($(this).is(":checked")) {
                someObj.fruitsGranted.push($(this).attr("data-id"));
            } else {
                someObj.fruitsDenied.push($(this).attr("data-id"));
            }
        });

        $('.cta-delete-more').attr('data-ids', someObj.fruitsGranted)
        // console.log(someObj.fruitsGranted)
    });

    $('.cta-delete-more').click(function () {
        // console.log(123);
        var ids = $('.cta-delete-more').attr('data-ids')
        var url = $('.cta-delete-more').attr('data-url')
        $('.nb-yes-all').attr('data-ids', ids)
        $('.nb-yes-all').attr('data-url', url)
        // console.log(url)
        $('#modal-delete-all').modal()
    })

    $('.nb-yes-all').click(function () {
        var ids = $('.nb-yes-all').attr('data-ids')
        var url = $('.nb-yes-all').attr('data-url')
        axios.post(url, {
                ids: ids
            })
            .then(function (response) {
                console.log(response)
                if (response.statusText == 'OK') {
                    var idArr = ids.split(',');
                    $.each(idArr, function (index, value) {
                        $('.remove-m' + value).fadeOut();
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            })
    })

})
