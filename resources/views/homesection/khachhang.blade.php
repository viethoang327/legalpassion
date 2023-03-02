<section id="khachhang" class="title">
    <div class="container">
        <div>
            <div>
                <h2>
                    <span>
                        KHÁCH HÀNG - ĐỐI TÁC
                    </span>
                </h2>
            </div>
        </div>
        <div class="title__categories">
            <div class="customer owl-carousel">
                @foreach($khachhang as $kh)
                <div class="customer-item">
                    <a href="">
                        <img class="customer-img" src="upload/khachhang/{{$kh->hinhanh}}" alt="{{$kh->hinhanh}}">
                        <h2>
                            <a href=""">{{$kh->ten}}</a>
                        </h2>
                    </a>
                </div>
                @endforeach
            </div> 
        </div>
    </div>
</section>
