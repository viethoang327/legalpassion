@extends('layout.index')
@section('title')
Trang chủ
@endsection
@section('content')
<main>
    <!-- SLIDE -->
    @include('homesection.slide')

    <!-- LÝ DO CHỌN LEGAL PASSION -->
    @include('homesection.gioithieu')

    <!-- SHORTCUT Lĩnh vực tư vấn -->
    @include('homesection.linhvuctuvan')

    <!-- SHORTCUT BÀI VIẾT NỔI BẬT -->
    @include('homesection.baivietnoibat')

    <!-- SHORTCUT BẢN TIN -->
    @include('homesection.bantin')

    <!-- SHORTCUT KHÁCH HÀNG - ĐỐI TÁC -->
    @include('homesection.khachhang')
</main>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $('.customer').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });
</script>
@endsection