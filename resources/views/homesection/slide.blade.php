<section>
        <div class="wrapper box">
            <!-- Lấy ra 5 slide ngẫu nhiên cho slide ở trang chủ -->
            @foreach($slide as $item)
            <div class="single-box">
                <img alt="{{$item->hinhslide}}" src="/upload/slide/{{$item->hinhslide}}">
            </div>
            @endforeach
        </div>
    </section>