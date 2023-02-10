<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/home.css') }}">
    <meta property="og:url" content="https://hoang.hungba.net" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Legalpassion Công ty tư vấn luật hàng đầu tại Việt Nam" />
    <meta property="og:description" content="Tư vấn mọi lĩnh vực, nhiệt huyết, tận tâm, chuyên nghiệp" />
    <meta property="og:image" content="https://hoang.hungba.net/img/legalpassion_slide.png" />
    <link rel="icon" type="image/x-icon" href="/img/Untitled-1.png">
    <script src="https://kit.fontawesome.com/72c4ac30ee.js" crossorigin="anonymous"></script>
    <title>Legal passion | @yield('title')</title>
    <base href="{{asset('')}}">
    @yield('CSS')
</head>

<body>
    <!-- HEADER -->
    @include('layout.header')
    <!-- BODY -->
    @yield('content')
    <!-- FOOTER -->
    @include('layout.footer')

    <a id="scrollUp" href="#top" style="position: fixed; z-index: 9999;">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
    <a id="inbMess" href="https://www.facebook.com/messages/t/862447354102533" style="position: fixed; z-index: 9999;">
        <i class="fa-brands fa-facebook-messenger"></i>
    </a>
    <a id="zaloMess" href="zalo://chat?token=0972465532" style="position: fixed; z-index: 9999;">
        <i><img src="img/icons8-zalo-cute-clipart-32.png" alt="zalo"></i>
    </a>

    <script>
        let header = document.querySelector('header');
        let group = document.querySelector('.group');
        let menuToggle = document.querySelector('.menuToggle');

        menuToggle.onclick = function() {
            header.classList.toggle('open');
        }
    </script>
    @yield('script')

</body>

</html>