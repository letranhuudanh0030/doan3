<div id="hd-menu">
    <nav class="navbar navbar-expand-lg navbar-dark p-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav">    
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Trang chủ</a>
                </li>
                {{-- <div id="accordion"> --}}

                    {{ showMenu($categories) }}
                {{-- </div> --}}
                <li class="nav-item">
                    <a href="{{ route('new') }}" class="nav-link">Tin tức</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Liên hệ</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<script>

    $(function(){
        var menu = $('.navbar').offset().top
        $(window).on('scroll', function(){

            let pos = $(window).scrollTop()
            if(pos > menu) {
                $('.navbar').addClass('fixed-top')
            } else {
                $('.navbar').removeClass('fixed-top')
            }
        })

    })

</script>