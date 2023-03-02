<header>
    <a href="{{ route('legalpassion.home') }}" class="logo">
        <img src="/img/Logo-removebg-preview.png" alt="Logo" height="80px">
    </a>
    <div class="group">
        <ul class="navigation">
            <li><a href="{{ route('legalpassion.home') }}" class="menu">Trang chủ</a></li>
            <li><a href="#" class="menu">Giới thiệu</a>
                <ul class="subMenu">
                    @foreach($gioithieu as $gt)
                    <li><a href="/gioithieu/{{$gt->id}}/{{$gt->tieudekhongdau}}.html">{{$gt->tieude}}</a></li>
                    <hr>
                    @endforeach
                </ul>
            </li>
            @include('layout.menu')
            <li><a href="{{route('legalpassion.home.tintuc')}}" class="menu">Bản tin</a></li>
            <li><a href="{{route('legalpassion.home.thutuc')}}" class="menu">Hướng dẫn thủ tục</a>
                <ul class="subMenu five">
                    @foreach($randomThuTuc as $thutuc)
                    <li><a href="thutuc/{{$thutuc->id}}/{{$thutuc->tieudekhongdau}}.html">{{$thutuc->tieude}}</a></li>
                    <hr>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{route('legalpassion.home.khachhang')}}" class="menu">Khách hàng</a></li>
            <li><a href="{{route('legalpassion.home.lienhe')}}" class="menu">Liên hệ</a></li>
        </ul>
        <div class="search">
            <form action="timkiem" method="GET">
                @csrf
                <label for="search"></label>
                <input type="text" class="search-box" id="search" name="keyword" placeholder="Tìm kiếm...">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="user">
            <div class="">
                <a href="#"><i class="fa-solid fa-user"></i></a>
            </div>
            <ul class="user-menu">
                @if(Auth::user())
                <a href="{{route('legalpassion.user.nguoidung')}}">
                    <div class="user-name">
                        <div><img src="upload/hinhdaidien/{{Auth::user()->hinhdaidien}}" alt="anhdaidien"></div>
                        <div>{{Auth::user()->name}}</div>
                    </div>
                </a>
                <li><a href="{{route('legalpassion.user.logout')}}">Đăng xuất</a></li>
                @else
                <div class="user-name">
                    <div><img src="img/hinhdaidien.png" alt="anhdaidien"></div>
                    <div>Xin chào</div>
                </div>

                <li><a href="{{route('legalpassion.user.login')}}">Đăng nhập</a></li>
                <li><a href="{{route('legalpassion.user.dangky')}}">Đăng ký</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class=" menuToggle">
        <i class="fa-solid fa-bars"></i>
    </div>
</header>