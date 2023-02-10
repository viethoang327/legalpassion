<footer>
    <div class="main-footer">
        <div class="main-footer__col1">
            <div class="main-footer__col1--contact">
                <section id="contact">
                    <h3>liên hệ</h3>
                    <p class="address">Số 10, ngõ 40 đường Trần Vỹ, phường Mai Dịch, quận Cầu Giấy, Hà Nội, Việt Nam
                    </p>
                    <p class="phone">+8497 246 55 32</p>
                    <p class="mail">
                        <a href="mailto:info.legalpassion@gmail.com">info.legalpassion@gmail.com</a>
                    </p>
                </section>
            </div>
            <div class="main-footer__col1--subscriber">
                <section>
                    <h3 id="location">Bản đồ theo googlemap</h3>
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=255&amp;height=130&amp;hl=en&amp;q=40 Tran Vy&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://embed-googlemap.com">embed-googlemap.com</a></div><style>.mapouter{position:relative;text-align:right;width:255px;height:130px;}.gmap_canvas {overflow:hidden;background:none!important;width:255px;height:130px;}.gmap_iframe {width:255px!important;height:130px!important;}</style></div>
                </section>
            </div>
        </div>
        <div class="main-footer__col1">
            <section class="main-footer__col1--ul col2">
                <h3>
                    Sơ đồ website
                </h3>
                <ul>
                    <li>
                        <a href="#">Con Người</a>
                    </li>
                    <li>
                        <a href="#">Về Chúng Tôi</a>
                    </li>
                    <li>
                        <a href="#location">Vị Trí</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Cộng Đồng</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Nghề Nghiệp</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.home.tintuc')}}">Tin tức</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.home.lienhe')}}">Liên Hệ</a>
                    </li>
                </ul>
            </section>
        </div>
        <div class="main-footer__col1">
            <section class="main-footer__col1--ul">
                <h3>lĩnh vực mở rộng</h3>
                <ul>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Tài Chính Ngân Hàng</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Tố Tụng</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Chính sách</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Bảo Hiểm</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Bất Động Sản</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Thuế</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Việc Làm, Lương Hưu</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.chuacapnhap')}}">Môi Trường</a>
                    </li>
                </ul>
            </section>
        </div>
        <div class="main-footer__col1">
            <section class="main-footer__col1--ul">
                <h3>bài viết khác</h3>
                <ul>
                    @foreach($thutucnoibat as $item)
                    <li class="times">
                        <a href="linhvuc/baiviet/{{$item->id}}/{{$item->tieudekhongdau}}.html">{{date("d",strtotime($item->updated_at))." tháng ".date("m, Y"),strtotime($item->updated_at)}}</a>
                        <h4>
                            <a href="linhvuc/baiviet/{{$item->id}}/{{$item->tieudekhongdau}}.html">{{$item->tieude}}</a>
                        </h4>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>

    <div class="main-footer icon">
        <div class="logo-footer">
            <a href="">
                <img src="/img/logo3.png" alt="">
            </a>
        </div>
        <div class="socials">
            <a href=""><i class="fa-brands fa-twitter twitter-icon"></i></a>
            <a href="https://www.facebook.com/luatgiahoinhap"><i class="fa-brands fa-facebook-f facebook-icon"></i></a>
            <a href=""><i class="fa-sharp fa-solid fa-rss rss-icon"></i></a>
            <a href=""><i class="fa-brands fa-linkedin-in linked-icon"></i></a>
            <a href=""><i class="fa-brands fa-pinterest-p pinterest-icon"></i></a>
            <a href=""><i class="fa-brands fa-google-plus-g gplus-icon"></i></a>
            <a href=""><i class="fa-brands fa-instagram ins-icon"></i></a>
        </div>
    </div>
</footer>