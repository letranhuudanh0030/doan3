<section id="nb-footer">
    <div class="container-fluid">
        <div class="col-11 mx-auto">
            <div class="row">
                <div class="col-sm col-md-6 col-lg-6 col-xl">
                    <h3 class="nb-title">Giờ làm việc</h3>
                    <div class="nb-content mt-4">
                            Thứ hai - thứ sáu : <br>

                            Sáng 07:45 - 11:45 <br>
                            Chiều 13:00 - 17:00 <br>
                            
                            Thứ bảy : <br>
                            
                            Sáng 07:45 - 11:45 <br> 
                            Buổi chiều nghỉ <br>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg-6 col-xl">
                    <h3 class="nb-title">cam kết</h3>
                    <div class="nb-content mt-4">
                        {!! $info->video !!}
                    </div>
                </div>

                <div class="col-sm col-md-6 col-lg-6 col-xl">
                    <h3 class="nb-title">Danh mục</h3>
                    <div class="nb-content mt-4">
                        <ul class="nb-footer-list">
                            @foreach ($categories_f as $category)                             
                                <li class="nb-footer-item">
                                    <a href="{{ route('shop', ['slug' => $category->slug, 'id' => $category->id]) }}" class="text-capitalize"><i class="fa fa-chevron-right mr-2"></i> {{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-sm col-md-6 col-lg-6 col-xl">
                    <h3 class="nb-title">Liên hệ nhanh</h3>
                    <div class="nb-content mt-4">
                        {!! $info->social !!}
                    </div>
                    <div class="nb-social">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="nb-copyright">
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mx-auto text-center">
                <p>Bản quyền © HUU DANH. {{ counter() }}</p>
            </div>
        </div>
    </div>
</section>
<a href="#" id="back-to-top" title="Back to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
<script>
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
</script>