<footer>
    <div class="main-footer">
        <div class="main-footer__col1">
            <div class="main-footer__col1--contact">
                <section id="contact">
                    <h3>liên hệ</h3>
                    <p class="address">
                    Số 28 ngõ 125 Nguyễn Ngọc Vũ, Phường Trung Hoà, Quận Cầu Giấy, Thành phố Hà Nội, Việt Nam
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
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=255&amp;height=130&amp;hl=en&amp;q=Số 28 ngõ 125 Nguyễn Ngọc Vũ, Phường Trung Hoà, Quận Cầu Giấy, Thành phố Hà Nội, Việt Nam&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://embed-googlemap.com">embed google maps</a></div>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                width: 255px;
                                height: 130px;
                            }

                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                width: 255px;
                                height: 130px;
                            }

                            .gmap_iframe {
                                width: 255px !important;
                                height: 130px !important;
                            }
                        </style>
                    </div>
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
                        <a href="#top">Giới Thiệu</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.home.linhvuc')}}">Lĩnh Vực Tư Vấn</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.home.tintuc')}}">Bản Tin</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.home.thutuc')}}">Hướng Dẫn Thủ tục</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.home.khachhang')}}">Khách Hàng - Đối Tác</a>
                    </li>
                    <li>
                        <a href="{{route('legalpassion.home.lienhe')}}">Liên Hệ</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.google.com/maps/place/28+Ng.+125+%C4%90.+Nguy%E1%BB%85n+Ng%E1%BB%8Dc+V%C5%A9,+Trung+Ho%C3%A0,+C%E1%BA%A7u+Gi%E1%BA%A5y,+H%C3%A0+N%E1%BB%99i,+Vietnam/@21.0087948,105.8071621,15.32z/data=!4m5!3m4!1s0x3135ac9e47335791:0xb263e5d5b9858e0b!8m2!3d21.0097673!4d105.8095011?hl=en">Vị Trí</a>
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
                        <a href="thutuc/{{$item->id}}/{{$item->tieudekhongdau}}.html">{{date("d",strtotime($item->updated_at))." tháng ".date("m, Y"),strtotime($item->updated_at)}}</a>
                        <h4>
                            <a href="thutuc/{{$item->id}}/{{$item->tieudekhongdau}}.html">{{$item->tieude}}</a>
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